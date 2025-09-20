<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body { font-family: sans-serif; }
        .header { margin-bottom: 20px; }
        .title { font-size: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Invoice {{ $invoiceNumber }}</div>
        <div>Date: {{ $invoiceDate }}</div>
    </div>

    <h3>Project Information</h3>

    <p><strong>Title:</strong> {{ $project->title }}</p>
    <p><strong>Description:</strong> {{ $project->description }}</p>

    <p><strong>Deadline:</strong> {{ $project->deadline }}</p>

</body>
</html>








