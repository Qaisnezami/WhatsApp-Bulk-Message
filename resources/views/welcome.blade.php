<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <form action="{{route('send')}}" method="post">
            @csrf
            <div id="numbers-container">
                <div class="number-input">
                    <input type="text" name="numbers[]" placeholder="Number" required>
                    <button type="button" onclick="removeNumberField(this)">Remove</button>
                </div>
            </div>

            <button type="button" onclick="addNumberField()">Add Another Number</button>

            <div>
                <textarea name="message" placeholder="Type your message here..." required></textarea>
            </div>

            <button type="submit">Send Messages</button>

        </form>

        <script>
            function addNumberField() {
                const container = document.getElementById('numbers-container');
                const newField = document.createElement('div');
                newField.className = 'number-input';
                newField.innerHTML = `
                    <input type="text" name="numbers[]" placeholder="Number" required>
                    <button type="button" onclick="removeNumberField(this)">Remove</button>
                `;
                container.appendChild(newField);
            }

            function removeNumberField(button) {
                button.parentElement.remove();
            }
        </script>
    </body>
</html>
