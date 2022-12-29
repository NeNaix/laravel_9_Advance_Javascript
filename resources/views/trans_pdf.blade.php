<html>
    <head>
        <style type="text/css">
            /* -------------------------------------
            GLOBAL
            A very basic CSS reset
        ------------------------------------- */
        * {
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            box-sizing: border-box;
            font-size: 14px;
        }

        img {
            max-width: 100%;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            line-height: 1.6;
        }

        /* Let's make sure all tables have defaults */
        table td {
            vertical-align: top;
        }

        /* -------------------------------------
            BODY & CONTAINER
        ------------------------------------- */
        body {
            background-color: #f6f6f6;
        }

        .body-wrap {
            background-color: #f6f6f6;
            width: 100%;
        }

        .container {
            display: block !important;
            max-width: 600px !important;
            margin: 0 auto !important;
            /* makes it centered */
            clear: both !important;
        }

        .content {
            max-width: 600px;
            margin: 0 auto;
            display: block;
            padding: 20px;
        }

        /* -------------------------------------
            INVOICE
            Styles for the billing table
        ------------------------------------- */
        .invoice {
            margin: 40px auto;
            text-align: left;
            width: 80%;
        }
        .invoice td {
            padding: 5px 0;
        }
        .invoice .invoice-items {
            width: 100%;
        }
        .invoice .invoice-items td {
            border-top: #eee 1px solid;
        }
        .invoice .invoice-items .total td {
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            font-weight: 700;
        }

            /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;
                font-size: 20px !important;

                /** Extra personal styles **/
                background-color: #008B8B;
                color: white;
                text-align: center;
                line-height: 35px;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 
                font-size: 20px !important;

                /** Extra personal styles **/
                background-color: #008B8B;
                color: white;
                text-align: center;
                line-height: 35px;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
           ACMERK
        </header>

        <footer>
            Copyright © 2022
        </footer>
        <main>
<table class="body-wrap">
    <tbody><tr>
        <td></td>
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td class="content-wrap aligncenter">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody><tr>
                                    <td class="content-block" align="center">
                                        <h2>Thanks for Our Affordable Games</h2>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td class="content-block">
                                        <table class="invoice">
                                            <tbody><tr>
                                                <td>Customer Name:<strong> {{$customer}}</strong><br>
                                                <br> {{date("d-m-Y H:i:s");}}<br>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr class="total">
                                                                <td >Service Name</td>
                                                                <td class="alignright">Price</td>
                                                                <td class="alignright">Qty</td>
                                                                <td class="alignright"></td>
                                                            </tr>
                                                            <?php $total = 0;?>
                                                    @foreach($trans as $record)
                                                        <tr>
                                                            <td>{{$record->sname}}</td>
                                                            <td class="alignright"> {{(string)$record->cost}}</td>
                                                            <td class="alignright"> {{(string)$record->count}}</td>
                                                            <td class="alignright"> {{(string)$record->total}}</td>
                                                        </tr>
                                                        <?php $total = $total + $record->total; ?>
                                                    @endforeach
                                                        
                                                       <tr class="total">
                                                            <td class="alignright" width="80%"></td>
                                                            <td class="alignright">Total</td>
                                                            <td class="alignright">:</td>
                                                            <td class="alignright"> {{(string)$total}}</td>
                                                        </tr>

                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block" align="center">
                                        VAPOR Inc. 123 Van Ness, San Francisco 94102
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table></div>
        </td>
        <td></td>
    </tr>
</tbody>
</table>
        </main>
    </body>
</html>