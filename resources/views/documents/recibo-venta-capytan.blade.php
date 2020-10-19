<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>

        .opacity{
            opacity: 0 !important;
        }
        body {
            font-family: Helvetica, Arial, Sans-Serif;
        }

        .table-header {
            background-color: #c6c6c6;
            text-align: center;

        }

        table,
        th,
        td,
        thead {
            border: 1px solid rgba(255, 0, 0, 0);
            border-spacing: 0px;


        }

        .campo-cliente {
            padding: 20px;
            text-align: center;
        }

        .container {
            width: 100%;
        }

        .center {
            margin: auto;
            /* width: 50%; */
            /* / border: 3px solid green; */
            /* padding: 10px; */
        }

        .center-text {
            text-align: center;
        }

        .row {
            display: inline-block;
        }

        .bussines-info-section {
            width: 35%;
            height: 100%;
            vertical-align: top;
        }

        .sale-client-section {
            width: 40%;
            height: 100%;
            vertical-align: top;
        }

        .sale-details-date-section {
            width: 20%;
            height: 100%;
            vertical-align: top;
        }

        .main-container {
            height: 600px;
            width: 100%;
        }

        .details-section {
            height: 30%;
        }

        .logo {
            height: 100px;
        }

        .bussines-info-text {
            font-size: 11px;
        }

        @media print {
            .th-color-gray {
                /* background-color: gainsboro; */
                /* -webkit-print-color-adjust: exact; */
            }
        }

        .product-table {
            width: 100%;
            border: none;

        }

        .product-table-th td {
            padding: 7px;
        }

        .product-table-details td {
            padding: 7px;
        }

        .notes-container {
            height: 65px;
            border: 1px rgba(255, 0, 0, 0);
            vertical-align: top;
            width: 90%;
            margin: auto;

        }

        .sign-container {
            height: 75px;
            position: relative;
        }

        .footer-container {
            height: 70px;
        }

        .footer-block {
            width: 35%;
            display: inline-block;
            height: 90%;
            vertical-align: top;
        }

        .footer-container h4 {
            font-weight: 400;
            margin-bottom: 0px;
            margin-top: 0px;
        }

        .footer-container hr {
            position: absolute;
            bottom: 0;
            left: 0;

            width: 70%;
            /* margin-left: 20%; */
            margin-left: 16%;
        }

        .notes-container p {
            margin-left: 2px;
            margin-right: 2px;
            font-size: 11px;
        }

    </style>
</head>

<body>

    <div class="center main-container">
        <div class="container details-section">
            <div class="bussines-info-section row center center-text">
                <div class="row center"></div>
                <img class="logo" style="opacity:0" src="{{ url('images/LOGO_COGELADORA_CAPYTAN.png') }}" alt="">
                {{-- <h2><span>CONGELADORA</span><span>CAPYTAN</span><span>SA DE CV</span>
                </h2> --}}
                <p class="bussines-info-text" style="color:rgba(255, 0, 0, 0);">Libramiento Benito Juárez 5521 Campo 10<br>Culiacán, Sinaloa, México 80396
                    <br> Teléfono 6677605235<br>congeladora@capytan.com <br> www.capytan.com</p>
            </div>
            <div class="sale-client-section row">
                <div class="center center-text">
                    <h1 style="margin-bottom: 10px; font-weight: 400; color:rgba(255, 0, 0, 0);">VENTA</h1>
                </div>
                <div class="center">
                    <table class="center" style="width: 80%">
                        <thead>
                            <tr class="center-text">
                                <td class="th-color-gray" style="color:rgba(255, 0, 0, 0);">CLIENTE</td>
                            </tr>
                        <tbody>
                            <tr>
                                <td class="center-text " style="padding: 20px">{{$sale->client}}</td>
                            </tr>
                        </tbody>
                        </thead>

                    </table>
                </div>
            </div>
            <div class="sale-details-date-section row center center-text" style="float: right; margin-top: 33px">
                {{-- Tabla salida --}}
                <table class="center" style="width: 150px; border-bottom: 0px">
                    <thead>
                        <tr class="center-text">
                            <td class="th-color-gray" style="color:rgba(255, 0, 0, 0);">SALIDA</td>
                        </tr>
                    <tbody>
                        <tr>
                            <td class="center-text" style="padding: 8px"></td>
                        </tr>
                    </tbody>
                    </thead>
                    {{-- Tabla fecha --}}
                </table>
                <table class="center" style="width: 150px">
                    <thead>
                        <tr class="center-text">
                            <th class="th-color-gray" style="font-weight: 400; color:rgba(255, 0, 0, 0);" colspan="3">FECHA</th>
                        </tr>
                    <tbody>
                        <tr>
                            <td class="center-text " style="padding: 8px">{{$sale->created_at->format('d')}}</td>
                            <td class="center-text " style="padding: 8px">{{$sale->created_at->format('m')}}</td>
                            <td class="center-text " style="padding: 8px">{{$sale->created_at->format('y')}}</td>
                        </tr>
                    </tbody>
                    </thead>

                </table>
            </div>
        </div>
        <div class="container">
            <table class="product-table center-text">
                <thead>
                    <tr class="th-color-gray product-table-th">
                        <td style="width:35%; color:rgba(255, 0, 0, 0);">PRODUCTO</td>
                        <td style="width:35%; color:rgba(255, 0, 0, 0);">KILOGRAMOS</td>
                        <td style="width:15%; color:rgba(255, 0, 0, 0);">PRECIO</td>
                        <td style="width:15%; color:rgba(255, 0, 0, 0);">IMPORTE</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sale_details as $sale_detail)
                        <tr class="product-table-details">
                            <td class="">{{$sale_detail->name}}</td>
                            <td class="">{{$sale_detail->quantity}}</td>
                            <td class="">{{$sale_detail->sale_price}}</td>
                            <td class="">@convert($sale_detail->sale_price * $sale_detail->quantity)</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No hay productos en esta venta</td>
                        </tr>        
                        @endforelse
                    <tr class="product-table-details">
                        <td colspan="2" style="border:none"></td>
                        <td class="th-color-gray" style="color:rgba(255, 0, 0, 0);">Total</td>
                        <td class="">@convert($sale->total)</td>
                    </tr>
                </tbody>
            </table>
            {{-- <div class="center"></div> --}}
        </div>
        <div class="center footer-container">
            <div class="center footer-block">
                <div class="sign-container">
                    {{-- <hr> --}}
                </div>
                {{-- <h4 class="center-text">AUTORIZA</h4> --}}
            </div>
            <div class="center footer-block">
                <div class="notes-container ">
                    <p class="">{{$sale->description}}</p>
                </div>
                <h4 class="center-text" style="margin-top: 9px;">NOTAS</h4>
            </div>
        </div>
    </div>

</body>
<script>
    window.onload = (() => {
       window.print()
    })

</script>

</html>
