<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    {{--    <link rel="stylesheet" href="/public/invoice.css" type="text/css">--}}
    <link rel="stylesheet" href="https://cdn.curlwind.com">
    <style type="text/css">
        @page {
            size: A4 landscape;
        }

        /*common class*/
        * {
            font-family: Verdana, Arial, sans-serif, Helvetica, Times;
        }

        .page-break {
            page-break-after: always;
        }

        .wrap {
            overflow-wrap: anywhere;
        }

        table {
            width: 100%;
        }

        .bg-gray {
            background-color: #F9FAFB;
        }

        .w-full {
            width: 100%;
        }

        .border {
            border: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-none {
            border: none;
        }

        .border-t {
            border-top: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-r {
            border-right: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-b {
            border-bottom: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-l {
            border-left: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-t-none {
            border-top: none;
        }

        .border-r-none {
            border-right: none;
        }

        .border-b-none {
            border-bottom: none;
        }

        .border-l-none {
            border-left: none;
        }

        .font-semibold {
            font-weight: lighter;
        }

        .font-bold {
            font-weight: bold;
        }

        .times {
            font-family: "Times New Roman", serif;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .left {
            text-align: left;
        }

        .lh-0 {
            line-height: 0.5;
        }

        .lh-1 {
            line-height: 1;
        }

        .lh-2 {
            line-height: 1.5;
        }

        .lh-3 {
            line-height: 2.5;
        }

        .lh-4 {
            line-height: 3;
        }

        .lh-5 {
            line-height: 3.5;
        }

        .lh-6 {
            line-height: 4;
        }

        .v-align-t {
            vertical-align: top;
        }

        .v-align-c {
            vertical-align: middle;
        }

        .v-align-b {
            vertical-align: bottom;
        }

        .p-0 {
            padding: 0;
        }

        .p-1 {
            padding: 1px;
        }

        .p-2 {
            padding: 2px;
        }

        .p-5 {
            padding: 5px;
        }

        .p-10 {
            padding: 10px;
        }

        .px-1 {
            padding: 0 1px;
        }

        .px-2 {
            padding: 0 2px;
        }

        .px-5 {
            padding: 0 5px;
        }

        .px-10 {
            padding: 0 10px;
        }

        .py-1 {
            padding: 1px 0;
        }

        .py-2 {
            padding: 2px 0;
        }

        .py-5 {
            padding: 5px 0;
        }

        .py-10 {
            padding: 10px 0;
        }

        .text-4xl {
            font-size: 36px;
        }

        .text-3xl {
            font-size: 28px;
        }

        .text-2xl {
            font-size: 24px;
        }

        .text-xl {
            font-size: 20px;
        }

        .text-lg {
            font-size: 16px;
        }

        .text-md {
            font-size: 12px;
        }

        .text-sm {
            font-size: 10px;
        }

        .text-xs {
            font-size: 9px;
        }
    </style>
</head>


<body class="bg-white-100 p-10">

<div class="flex items-center justify-center gap-x-6 border border-gray-300 py-2">
    <div class="">
        @if($cmp->get('logo')!='no_image')
            <img src="{{ public_path('/storage/images/'.$cmp->get('logo'))}}" alt="company logo" class="w-[90px]"/>
        @else
            <img src="{{ public_path('images/sk-logo.jpeg') }}" alt="" class="w-[90px]">
        @endif
    </div>

    <div class="flex-col">
        <h1 class="text-2xl font-bold tracking-wider  uppercase">{{$cmp->get('company_name')}}</h1>
        <p class="text-xs">{{$cmp->get('address_1')}},{{$cmp->get('address_2')}}, {{$cmp->get('city')}}</p>
        <p class="text-xs">{{$cmp->get('contact')}} - {{$cmp->get('email')}}</p>
        <p class="text-xs">{{$cmp->get('gstin')}}</p>
    </div>

</div>

<div class=" w-full bg-gray-100 text-sm py-2 px-1 font-bold border-l border-b border-r border-gray-300">
    {{$mode_name}}
</div>

<table class="w-full border-b border-gray-300">
    <thead class="font-semibold text-[10px] bg-gray-50">
    <tr class="py-2 border-b border-r border-gray-300 tracking-wider">
        <th class="py-2 w-[3%] px-1 border-r border-l border-gray-300 text-center">S.No</th>
        <th class="py-2  border-r border-gray-300">Contact</th>
        <th class="py-2 w-[10%] border-r border-gray-300">Type</th>
        <th class="py-2 w-[20%] border-r border-gray-300">Mode of Payments</th>
        <th class="py-2 w-[10%] border-r px-1 border-gray-300">Amount</th>

        <body>

        <table class="border w-full">
            <tr>
                <td width="35%" class="right">
                    @if($cmp->get('logo')!='no_image')
                        <img src="{{ public_path('/storage/images/'.$cmp->get('logo'))}}" alt="company logo"
                             width="130px"/>
                    @else
                        <img src="{{ public_path('images/sk-logo.jpeg') }}" alt="" width="130px">
                    @endif
                </td>
                <td width="65%" class="lh-0 left">
                    <div class=" lh-1 font-bold times text-4xl">{{$cmp->get('company_name')}}</div>
                    <div class="lh-2 text-md v-align-b">
                        <div class="times">{{$cmp->get('address_1')}}</div>
                        <div class="times">{{$cmp->get('address_2')}}, {{$cmp->get('city')}}</div>
                        <div class="times">{{$cmp->get('contact')}} - {{$cmp->get('email')}}</div>
                        <div class="times">{{$cmp->get('gstin')}}</div>
                    </div>
                </td>
            </tr>
        </table>
        <table class="border v-align-c border-t-none">
            <tr class="bg-gray center font-bold text-lg p-1">
                <td class="center py-5">{{$mode_name}}</td>
            </tr>
        </table>
        <table class="border border-t-none">
            <tr class="bg-gray text-md lh-2 border-b">
                <th height="26px" width="5%" class="border-r">S.No</th>
                <th width="auto" class="border-r">Contact</th>
                <th width="12%" class="border-r">Type</th>
                <th width="12%" class="border-r">Mode of Payments</th>
                <th width="15%" class="border-r">Amount</th>

            </tr>
            @foreach($list as $index=>$row)

                <tr class="text-[10px] border-b border-r border-gray-300 self-start ">
                    <td class="py-2 text-center border-l border-r border-gray-300">{{$index+1}}</td>
                    <td class="py-2 text-start px-0.5 border-r border-gray-300">{{$row->contact->vname}}</td>
                    <td class="py-2 text-center px-0.5 border-r border-gray-300">{{\Aaran\Transaction\Models\Transaction::common($row->receipttype_id)}}</td>
                    <td class="py-2 text-center px-0.5 border-r border-gray-300">{{Aaran\Common\Models\Common::find($row->trans_type_id)->vname}}</td>
                    <td class="py-2 text-right border-r px-2 border-gray-300">{{$row->vname+0}}</td>



                <tr class="text-md center v-align-c">
                    <td height="26px" class="center border-r">{{$index+1}}</td>
                    <td class="left border-r ">{{$row->contact->vname}}</td>
                    <td class="center border-r ">{{\Aaran\Transaction\Models\Transaction::common($row->receipttype_id)}}</td>
                    <td class="center border-r ">{{Aaran\Common\Models\Common::find($row->trans_type_id)->vname}}</td>
                    <td class="right border-r px-2">
                        {{number_format($row->vname,2,'.','')}}</td>
                </tr>

            @endforeach
            @php
                $total = $list->sum('vname');
            @endphp
            <tr class="text-md center v-align-c border-t  font-bold">
                <td class="center border-r px-2 py-10" colspan="3">Total</td>
                <td class="right border-r px-2" colspan="2">{{number_format($total,2,'.','')}}</td>

            </tr>
        </table>
        </body>
</html>

