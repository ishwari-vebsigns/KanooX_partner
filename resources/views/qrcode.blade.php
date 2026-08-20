@extends('layouts.admin-app')
@section('content')

<style>
/* ===== REALISTIC BUSINESS QR POSTER ===== */

.articles {
    display: flex;
    justify-content: center;
    margin-top: 24px;
}

/* Main poster card */
article {
    width: 380px;
    background: #0c0c3e;
    border: 1px solid #cfcfcf;
    border-radius: 4px;
    box-shadow: none;
    font-family: Arial, Helvetica, sans-serif;
}

/* Inner wrapper */
.article-wrapper {
    padding: 22px 20px 24px;
    text-align: center;
}

/* Logo area */
figure {
    margin: 0;
    padding-bottom: 12px;
    border-bottom: 1px solid #e3e3e3;
}

figure img {
    max-width: 300px;
}

/* Title text */
.qr-title {
    margin-top: 14px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;
}

/* Subtitle */
.qr-subtitle {
    font-size: 13px;
    color: #fff;
    margin-top: 4px;
}

/* QR area */
.article-body {
    margin-top: 16px;
}
/* Force QR SVG path color */
/*.article-body svg path {*/
/*    fill: #0c0c3e !important;*/
/*}*/
/*.article-body svg path {*/
/*    fill: #ffffff !important;*/
/*}*/
/* Remove SVG background */
/*.article-body svg {*/
/*    background: transparent !important;*/
/*}*/

/* Make sure background rect (quiet zone) is transparent */
/*.article-body svg rect:first-child {*/
/*    fill: transparent !important;*/
/*}*/

/* QR size for real scanning */
.article-body svg,
.article-body img {
    width: 260px;
    height: 260px;
    margin: 10px auto;
    display: block;
}

/* Scan instruction */
.scan-text {
    font-size: 14px;
    font-weight: 600;
    margin-top: 6px;
    color: #fff;
}

/* Agent name */
.agent-name {
    margin-top: 10px;
    font-size: 15px;
    font-weight: 600;
    color: #fff;
}

/* Footer note */
.qr-footer {
    margin-top: 14px;
    padding-top: 10px;
    border-top: 1px solid #e3e3e3;
    font-size: 12px;
    color: #666;
}

/* Responsive */
@media (max-width: 768px) {
    article {
        width: 100%;
    }

    .article-body svg,
    .article-body img {
        width: 230px;
        height: 230px;
    }
}

/* Print safe */
@media print {
    body {
        background: #ffffff !important;
    }
    article {
        border: 1px solid #000;
    }
}

/* Hidden clone for export */
#qr-export-wrapper {
    position: fixed;
    top: -2000px;
    left: 0;
    background: #0c0c3e;
    padding: 20px;
    z-index: -1;
}
.article-body svg {
    background: transparent !important;
}
.article-body svg rect:first-child {
    fill: transparent !important;
}
.article-body svg path {
    fill: #ffffff !important;
}
/* Give SVG internal breathing space for canvas export */
#qr-export-wrapper svg {
    padding: 6px !important;
    box-sizing: content-box !important;
}


</style>

<!-- Datatable -->
<link href="{{$base_url}}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="{{$base_url}}/css/style.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


<div class="content-body">
    <div class="container-fluid">

        <!-- ===== BANNER (UNCHANGED) ===== -->
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome {{ Auth::user()->name }}!</h4>
                    @if(Auth::user()->role_id == 2)
                        <p class="mb-0">Agent ID: {{ Auth::user()->new_id }}</p>
                    @endif
                </div>
            </div>

            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="javascript:void(0)">Agent QR</a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- ===== END BANNER ===== -->
        <div class="d-flex justify-content-end mb-3">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
            Download QR
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#" onclick="downloadQR('png')">Download as Image</a>
            <a class="dropdown-item" href="#" onclick="downloadQR('pdf')">Download as PDF</a>
        </div>
    </div>
</div>


        <div class="row">
            <section class="articles">
                <article id="qrCard">
                    <div class="article-wrapper">

                        <figure>
                            <img src="{{ $base_url }}/login-images/logo.png" alt="Loan Sarovar">
                        </figure>

                        <div class="qr-title">Instant Loan Application</div>
                        <div class="qr-subtitle">Fast • Secure • 100% Digital</div>

                        <div class="article-body">
                            {!! htmlspecialchars_decode($data->agent_qr->qr_code) !!}
                        </div>

                        <div class="scan-text">Scan QR Code to Apply</div>

                        <div class="agent-name">
                            {{ $data->name }}
                        </div>

                        <div class="qr-footer">
                            Powered by Loan Sarovar
                        </div>

                    </div>
                </article>
            </section>
        </div>

    </div>
</div>


<script src="{{$base_url}}/js/quixnav-init.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{$base_url}}/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{$base_url}}/js/plugins-init/datatables.init.js"></script>
<script>

function svgToPng(svgEl, scale = 3, padding = 12) {
    return new Promise(resolve => {
        const svgData = new XMLSerializer().serializeToString(svgEl);

        const svgBlob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
        const url = URL.createObjectURL(svgBlob);

        const img = new Image();
        img.onload = () => {
            const canvas = document.createElement('canvas');

            const w = svgEl.viewBox.baseVal.width || svgEl.clientWidth;
            const h = svgEl.viewBox.baseVal.height || svgEl.clientHeight;

            canvas.width = (w + padding * 2) * scale;
            canvas.height = (h + padding * 2) * scale;

            const ctx = canvas.getContext('2d');
            ctx.fillStyle = '#0c0c3e';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.drawImage(
                img,
                padding * scale,
                padding * scale,
                w * scale,
                h * scale
            );

            URL.revokeObjectURL(url);
            resolve(canvas.toDataURL('image/png'));
        };
        img.src = url;
    });
}

async function downloadQR(type) {
    const original = document.getElementById('qrCard');
    const clone = original.cloneNode(true);

    const wrapper = document.createElement('div');
    wrapper.id = 'qr-export-wrapper';
    wrapper.appendChild(clone);
    document.body.appendChild(wrapper);

    const svg = clone.querySelector('svg');

    if (svg) {
        const pngData = await svgToPng(svg);
        const img = document.createElement('img');
        img.src = pngData;
        img.style.width = '260px';
        img.style.height = '260px';
        svg.replaceWith(img);
    }

    html2canvas(clone, {
        scale: 3,
        useCORS: true
    }).then(canvas => {

        if (type === 'png') {
            const link = document.createElement('a');
            link.download = 'loan-sarovar-qr.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
        }

        if (type === 'pdf') {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');

            const imgData = canvas.toDataURL('image/png');
            const imgWidth = 180;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;

            pdf.addImage(imgData, 'PNG', 15, 20, imgWidth, imgHeight);
            pdf.save('loan-sarovar-qr.pdf');
        }

        document.body.removeChild(wrapper);
    });
}


</script>



@endsection
