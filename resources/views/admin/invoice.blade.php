<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>FitFriend Personal Training</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="{{URL::asset("assets/img/test001.png")}}" style="background-color: black;padding: 10px;margin-top: 20px;">
                        </td>

                        <td>
                            <h3>Factuur</h3>
                            Factuurnummer #{{$order->id}}<br>
                            Factuurdatum: @php setlocale(LC_TIME, 'nl_NL'); $time = strtotime($order->created_at) ;echo strftime('%e %B %Y', $time); @endphp
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <h3>Fitfriend Personal training</h3>
                            Ambachtsweg 6<br>
                            4854 MK Bavel <br>

                        </td>

                        <td>
                            <h3>Klantgegevens</h3>
                            {{$order->user->name}}<br>
                            {{$order->user->address}}<br>
                            {{$order->user->postalcode}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>
                Omschrijving
            </td>

            <td>
                Prijs
            </td>
        </tr>

        <tr class="item last">
            <td>
                {{$order->product->name}} (Aantal lessen: {{$order->product->amount_of_lessons}})
            </td>

            <td>
                @php echo $moneyFormat->formatCurrency($order->product->price, "EUR") @endphp
            </td>
        </tr>

        <tr class="total">
            <td></td>

            <td>
                @php $taxPrice = $order->product->price * 1.09; $tax = $taxPrice - $order->product->price; @endphp
                SUBTOTAAL: @php echo $moneyFormat->formatCurrency($order->product->price, "EUR"); @endphp<br>
                BTW (9%): @php echo $moneyFormat->formatCurrency($tax, "EUR") @endphp <br>
                Totaal: @php echo $moneyFormat->formatCurrency($taxPrice, "EUR"); @endphp<br>
            </td>
        </tr>
    </table>
</div>
<div class="test" style="position: absolute;top: 55%;">
    <b>BTW Nummer:</b> NL229083729B01
    <b>KVK Nummer:</b> 75942968
    <b>IBAN:</b> NL82 SNSB 0787468738
</div>
</body>
</html>
