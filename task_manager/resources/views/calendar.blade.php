@extends('layouts.master')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">📅 My Task Calendar</h1>
    <div class="calendar-container bg-white rounded-lg shadow-lg p-4">
        <div class="calendar-header flex justify-between items-center mb-4">
            <button id="prevMonth" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">‹</button>
            <h2 id="currentMonth" class="text-xl font-semibold"></h2>
            <button id="nextMonth" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">›</button>
        </div>
        <div class="calendar-grid grid grid-cols-7 gap-1">
            <div class="day-header text-center font-semibold p-2 bg-gray-100">Sun</div>
            <div class="day-header text-center font-semibold p-2 bg-gray-100">Mon</div>
            <div class="day-header text-center font-semibold p-2 bg-gray-100">Tue</div>
            <div class="day-header text-center font-semibold p-2 bg-gray-100">Wed</div>
            <div class="day-header text-center font-semibold p-2 bg-gray-100">Thu</div>
            <div class="day-header text-center font-semibold p-2 bg-gray-100">Fri</div>
            <div class="day-header text-center font-semibold p-2 bg-gray-100">Sat</div>
            <!-- Days will be added here by JavaScript -->
        </div>
    </div>
</div>

<script>
class SimpleCalendar {
    constructor() {
        this.currentDate = new Date();
        this.tasks = [];
        this.init();
    }

    async init() {
        await this.loadTasks();
        this.render();
        this.bindEvents();
    }

    async loadTasks() {
        try {
            const response = await fetch('{{ route("tasks.json") }}');
            this.tasks = await response.json();
        } catch (error) {
            console.error('Error loading tasks:', error);
        }
    }

    render() {
        const monthYear = this.currentDate.toLocaleDateString('en-US', {
            month: 'long',
            year: 'numeric'
        });
        document.getElementById('currentMonth').textContent = monthYear;

        const firstDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), 1);
        const lastDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 0);
        const startDate = new Date(firstDay);
        startDate.setDate(startDate.getDate() - firstDay.getDay());

        const grid = document.querySelector('.calendar-grid');
        // Remove existing days (keep headers)
        const dayElements = grid.querySelectorAll('.calendar-day');
        dayElements.forEach(el => el.remove());

        for (let i = 0; i < 42; i++) {
            const date = new Date(startDate);
            date.setDate(startDate.getDate() + i);

            const dayElement = this.createDayElement(date);
            grid.appendChild(dayElement);
        }
    }

    createDayElement(date) {
        const dayEl = document.createElement('div');
        dayEl.className = 'calendar-day min-h-20 p-1 border border-gray-200 cursor-pointer hover:bg-gray-50';

        const dayNumber = document.createElement('div');
        dayNumber.className = 'text-sm font-medium';
        dayNumber.textContent = date.getDate();

        if (date.getMonth() !== this.currentDate.getMonth()) {
            dayEl.classList.add('text-gray-400');
        }

        dayEl.appendChild(dayNumber);

        // Add tasks for this day
        const dayTasks = this.getTasksForDate(date);
        dayTasks.forEach(task => {
            const taskEl = document.createElement('div');
            taskEl.className = 'text-xs bg-green-100 text-green-800 p-1 mt-1 rounded truncate';
            taskEl.textContent = task.title;
            taskEl.title = task.description;
            dayEl.appendChild(taskEl);
        });

        return dayEl;
    }

    getTasksForDate(date) {
        const dateStr = date.toISOString().split('T')[0];
        return this.tasks.filter(task => {
            const taskDate = new Date(task.date).toISOString().split('T')[0];
            return taskDate === dateStr;
        });
    }

    bindEvents() {
        document.getElementById('prevMonth').addEventListener('click', () => {
            this.currentDate.setMonth(this.currentDate.getMonth() - 1);
            this.render();
        });

        document.getElementById('nextMonth').addEventListener('click', () => {
            this.currentDate.setMonth(this.currentDate.getMonth() + 1);
            this.render();
        });
    }
}

document.addEventListener('DOMContentLoaded', () => new SimpleCalendar());
</script>
@endsection
