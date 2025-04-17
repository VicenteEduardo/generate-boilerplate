{{-- resources/views/upload-sql.blade.php --}}
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload SQL</title>
    <script src="https://cdn.tailwindcss.com"></script>
      {{-- sweetalert --}}
      <!-- SweetAlert2 CSS (opcional, se quiser customizar mais bonito) -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">

      <!-- SweetAlert2 JS -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f3f4f6;
            background-image: url('https://laravel.com/img/logomark.min.svg'); /* Imagem do Laravel */
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 1010px;
            background-attachment: fixed;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.5);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

    <div class="overlay">
        <div class="bg-white bg-opacity-90 p-8 rounded-xl shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">Upload de Arquivo SQL</h1>

            @if (session('message'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <form id="upload-form" action="{{ route('sql.process') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Selecione o ficheiro SQL</label>
                    <input id="sql_file" type="file" name="sql_file" required
                        class="block w-full text-sm text-gray-600
                               file:mr-4 file:py-2 file:px-4
                               file:rounded-full file:border-0
                               file:text-sm file:font-semibold
                               file:bg-red-50 file:text-red-700
                               hover:file:bg-red-100
                               cursor-pointer" />
                </div>

                <div id="progress-container" class="hidden w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                    <div id="progress-bar" class="bg-red-600 h-full w-0 transition-all duration-500"></div>
                </div>

                <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-xl">
                    Processar
                </button>
            </form>
        </div>
    </div>

    <script>
        const form = document.getElementById('upload-form');
        const fileInput = document.getElementById('sql_file');
        const progressBar = document.getElementById('progress-bar');
        const progressContainer = document.getElementById('progress-container');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            if (fileInput.files.length === 0) {
                alert('Por favor selecione um arquivo.');
                return;
            }

            progressContainer.classList.remove('hidden');
            progressBar.style.width = '0%';

            const formData = new FormData(form);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);

            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    const percent = (e.loaded / e.total) * 100;
                    progressBar.style.width = percent + '%';
                }
            });

            xhr.onload = function() {
                if (xhr.status === 200) {
                    progressBar.style.width = '100%';

                    Swal.fire({
                        icon: 'success',
                        title: 'Arquivo carregado com sucesso!',
                        showConfirmButton: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro ao enviar o arquivo.',
                        text: 'Tente novamente!'
                    });
                }
            };


    </script>
    @if (session('create'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Arquivo carregado com sucesso!',
            showConfirmButton: false,
            timer: 3000, // fecha sozinho depois de 3 segundos
            timerProgressBar: true,
        });
    </script>
    @endif

</body>
</html>
