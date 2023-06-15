@extends('template.principal')
@section('content')
<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
<br>
<button class="btn btn-primary d-block m-auto" id="qr"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
    <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
</svg><strong class="ml-2">Capturar QRCode</strong></button>
<br>
<video id="webcam-preview"></video>


<script>
    const codeReader = new ZXing.BrowserQRCodeReader();
    const btnQr = document.getElementById('qr');
    let Janela = null;
    
    btnQr.addEventListener('click', function(){
            codeReader.decodeFromVideoDevice(null, 'webcam-preview', (result, err) => {
            if (result) {
                var authToken = document.cookie;
                if (Janela != true) {
                    Janela = true;
                    window.open(result.text+"?"+authToken, '_self'); 
                }
            }
            
            if (err) {
                
                if (err instanceof ZXing.NotFoundException) {
                    console.log('No QR code found.')
                }
                
                if (err instanceof ZXing.ChecksumException) {
                    console.log('A code was found, but it\'s read value was not valid.')
                }
                
                if (err instanceof ZXing.FormatException) {
                    console.log('A code was found, but it was in a invalid format.')
                }
            }
        })
    })
</script>
@endsection