<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('helps.teacher.{teacherId}', function ($user, $teacherId) {
    return (int) $user->id === (int) $teacherId;
});

Broadcast::channel('helps.student.{studentId}', function ($user, $studentId) {
    return (int) $user->id === (int) $studentId;
});
