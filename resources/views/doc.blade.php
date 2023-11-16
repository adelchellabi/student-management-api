<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Student Management API Documentation</title>
    <script src="https://unpkg.com/swagger-ui-dist@4/swagger-ui-bundle.js"></script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@4/swagger-ui.css" />
</head>

<body>
    <div id="swagger-ui"></div>
    <script>
        window.onload = function() {
            const ui = SwaggerUIBundle({
                url: "{{ url('/api-docs') }}",
                dom_id: "#swagger-ui",
                deepLinking: true,
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIBundle.SwaggerUIStandalonePreset,
                ],
                plugins: [SwaggerUIBundle.plugins.DownloadUrl],
            });
            window.ui = ui;
        };
    </script>
</body>

</html>
