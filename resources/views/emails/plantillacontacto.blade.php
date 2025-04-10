<div
    style="
    background-color: #6c757d;
    padding: 2rem;
    border-radius: 10px;
    color: #f8f9fa;
    font-family: Arial, sans-serif;
    max-width: 600px;
    margin: 0 auto;
">

    <h1
        style="
    text-align: center;
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    color: #ffffff;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
">
        FORMULARIO DE CONTACTO
    </h1>

    <div
        style="
    background-color: #495057;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
">

        <p style="font-size: 1.1rem; line-height: 1.6;">
            <strong>Enviado por:</strong> {{ $nombre }}<br>
            <strong>Email:</strong> {{ $email }}
        </p>

        <hr style="border-color: #adb5bd; margin: 1.5rem 0;">

        <div
            style="
    background-color: #5a6268;
    padding: 1.2rem;
    border-radius: 6px;
    font-size: 1rem;
    line-height: 1.5;
">
            {{ $contenido }}
        </div>

    </div>

    <p style="
    text-align: center;
    margin-top: 1rem;
    font-size: 0.9rem;
    color: #dee2e6;
">
        Este mensaje fue enviado a través del formulario de contacto
    </p>

</div>
