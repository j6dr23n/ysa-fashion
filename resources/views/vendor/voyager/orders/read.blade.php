@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }} {{ ucfirst($dataType->getTranslatedAttribute('display_name_singular')) }} &nbsp;

        @can('edit', $dataTypeContent)
            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                {{ __('voyager::generic.edit') }}
            </a>
        @endcan
        @can('delete', $dataTypeContent)
            @if($isSoftDeleted)
                <a href="{{ route('voyager.'.$dataType->slug.'.restore', $dataTypeContent->getKey()) }}" title="{{ __('voyager::generic.restore') }}" class="btn btn-default restore" data-id="{{ $dataTypeContent->getKey() }}" id="restore-{{ $dataTypeContent->getKey() }}">
                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.restore') }}</span>
                </a>
            @else
                <a href="javascript:;" title="{{ __('voyager::generic.delete') }}" class="btn btn-danger delete" data-id="{{ $dataTypeContent->getKey() }}" id="delete-{{ $dataTypeContent->getKey() }}">
                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.delete') }}</span>
                </a>
            @endif
        @endcan
        <button class="print-link btn btn-primary" onclick="jQuery.print('#printObj')"><i class="voyager-book-download"></i>Print</button>   
        @can('browse', $dataTypeContent)
        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            {{ __('voyager::generic.return_to_list') }}
        </a>
        @endcan
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">

                    <div class="panel-heading" style="padding-bottom:0;">
                        <h3 class="panel-title">Products</h3>
                    </div>
                    <div class="panel-body" style="border-top:0;">
                        <h2 style="text-align: center"><b>Products</b></h2>
                                <table class="table table-bordered table-dark">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Single Price</th>
                                        <th>Quantity</th>
                                        <th>Color</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($products as $product)
                                      <tr>
                                        <th><img src="{{ productImage($product->image) }}" width="50px" height="50px" alt="" style="margin-left:20px;"></th>
                                        <td><p style="font-weight:bold; font-size:18px;">{{ $product->name }}</p></td>
                                        <td><p style="font-weight:bold; font-size:18px;">{{ presentPrice($product->price) }}</p></td>
                                        <td><p style="font-weight:bold; font-size:18px;">{{ $product->pivot->quantity }}</p></td>
                                        <td><p style="font-weight: bold">{{ $product->pivot->color }}</p></td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                    </div>
                    <!-- form start -->
                    @foreach($dataType->readRows as $row)
                        @php
                        if ($dataTypeContent->{$row->field.'_read'}) {
                            $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                        }
                        @endphp
                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">{{ $row->getTranslatedAttribute('display_name') }}</h3>
                        </div>

                        <div class="panel-body" style="padding-top:0;">
                            @if (isset($row->details->view))
                                @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                            @elseif($row->type == "image")
                                <img class="img-responsive"
                                     src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
                            @elseif($row->type == 'multiple_images')
                                @if(json_decode($dataTypeContent->{$row->field}))
                                    @foreach(json_decode($dataTypeContent->{$row->field}) as $file)
                                        <img class="img-responsive"
                                             src="{{ filter_var($file, FILTER_VALIDATE_URL) ? $file : Voyager::image($file) }}">
                                    @endforeach
                                @else
                                    <img class="img-responsive"
                                         src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
                                @endif
                            @elseif($row->type == 'relationship')
                                 @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details])
                            @elseif($row->type == 'select_dropdown' && property_exists($row->details, 'options') &&
                                    !empty($row->details->options->{$dataTypeContent->{$row->field}})
                            )
                                <?php echo $row->details->options->{$dataTypeContent->{$row->field}};?>
                            @elseif($row->type == 'select_multiple')
                                @if(property_exists($row->details, 'relationship'))

                                    @foreach(json_decode($dataTypeContent->{$row->field}) as $item)
                                        {{ $item->{$row->field}  }}
                                    @endforeach

                                @elseif(property_exists($row->details, 'options'))
                                    @if (!empty(json_decode($dataTypeContent->{$row->field})))
                                        @foreach(json_decode($dataTypeContent->{$row->field}) as $item)
                                            @if (@$row->details->options->{$item})
                                                {{ $row->details->options->{$item} . (!$loop->last ? ', ' : '') }}
                                            @endif
                                        @endforeach
                                    @else
                                        {{ __('voyager::generic.none') }}
                                    @endif
                                @endif
                            @elseif($row->type == 'date' || $row->type == 'timestamp')
                                @if ( property_exists($row->details, 'format') && !is_null($dataTypeContent->{$row->field}) )
                                    {{ \Carbon\Carbon::parse($dataTypeContent->{$row->field})->formatLocalized($row->details->format) }}
                                @else
                                    {{ $dataTypeContent->{$row->field} }}
                                @endif
                            @elseif($row->type == 'checkbox')
                                @if(property_exists($row->details, 'on') && property_exists($row->details, 'off'))
                                    @if($dataTypeContent->{$row->field})
                                    <span class="label label-info">{{ $row->details->on }}</span>
                                    @else
                                    <span class="label label-primary">{{ $row->details->off }}</span>
                                    @endif
                                @else
                                {{ $dataTypeContent->{$row->field} }}
                                @endif
                            @elseif($row->type == 'color')
                                <span class="badge badge-lg" style="background-color: {{ $dataTypeContent->{$row->field} }}">{{ $dataTypeContent->{$row->field} }}</span>
                            @elseif($row->type == 'coordinates')
                                @include('voyager::partials.coordinates')
                            @elseif($row->type == 'rich_text_box')
                                @include('voyager::multilingual.input-hidden-bread-read')
                                {!! $dataTypeContent->{$row->field} !!}
                            @elseif($row->type == 'file')
                                @if(json_decode($dataTypeContent->{$row->field}))
                                    @foreach(json_decode($dataTypeContent->{$row->field}) as $file)
                                        <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: '' }}">
                                            {{ $file->original_name ?: '' }}
                                        </a>
                                        <br/>
                                    @endforeach
                                @else
                                    <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($row->field) ?: '' }}">
                                        {{ __('voyager::generic.download') }}
                                    </a>
                                @endif
                            @else
                                @include('voyager::multilingual.input-hidden-bread-read')
                                <p>{{ $dataTypeContent->{$row->field} }}</p>
                            @endif
                        </div><!-- panel-body -->
                        @if(!$loop->last)
                            <hr style="margin:0;">
                        @endif
                    @endforeach
                    {{-- <div class="col-md-12" id="printObj" style="border:2px solid black; margin-top:20px;">
                        <div class="row">
                            <div class="col-md-9">
                                @php
                                    $date =date('Y-m-d');
                                @endphp
                                <h3>Date : {{ $date }}</h3>
                                <div style="
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;">
                                    <img src="/images/logo.jpg" style=" overflow:auto;" width="75px" height="75px" alt="">
                                    <h3 style="text-align: center; display:inline; padding:10px; font-weight:bolder;">ZAY MIN HTET Co., Ltd</h3>
                                </div>
                                <div style="text-align: center">
                                    <h4>No.(200/206),9th floor,Bet: 134x135 Street,Sat Yone Road,Ma-U-Gone Quarter,Tamwe Township,Yangon,Myanmar.</h4>
                                    <h4><i class="voyager-phone"> +95-9-898155551, +95-9-775545655</i></h4>
                                    <h4> Email: zayminhtetcompanylimited@gmail.com</h4>
                                </div>
                                <hr>
                                <h3 style="text-align: center;">INVOICE</h3>
                                <hr>
                                <h4 style="display: inline-block">ဝယ်ယူသူအမည် : {{ $user->Name }}</h4>
                                <h4 style="display: inline-block;float:right">ဖုန်းနံပါတ် : +95-{{ $user->PhNumber }}</h4>
                                <br>
                                <h4 style="display: inline-block">ရာထူး | ဋ္ဌာန : {{ $user->PositionDepartment }}</h4>
                                <h4 style="display: inline-block;float:right">လက်ရှိတာဝန်ထမ်းဆောင်သောရုံး : {{ $user->CurrentOffice }}</h4>
                                <hr>
                                <table class="table table-bordered table-dark">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th>ပစ္စည်းဓာတ်ပုံ</th>
                                        <th>ပစ္စည်းအမည်</th>
                                        <th>ပစ္စည်းဈေးနူန်း(တစ်ခု)</th>
                                        <th>ပစ္စည်းအရေအတွက်</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($products as $product)
                                      <tr>
                                        <th><img src="{{ productImage($product->image) }}" width="50px" height="50px" alt="" style="margin-left:20px;"></th>
                                        <td><p style="font-weight:bold; font-size:18px;">{{ $product->name }}</p></td>
                                        <td><p style="font-weight:bold; font-size:18px;">{{ presentPrice($product->price) }}</p></td>
                                        <td><p style="font-weight:bold; font-size:18px;">{{ $product->pivot->quantity }}</p></td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                            </div>
                            <div class="col-md-3">
                                @php
                                   $discount = $order->discount;
                                   $balance = $user->MoneyLeft;
                                   $oneMonthBalance = $balance;
                                @endphp
                                <br>
                                <div class="details" style="border:4px solid black;border-radius:10px; padding:15px; text-align:right;">
                                    <p style="font-weight:bold; font-size:18px;">ဈေးနူန်း : {{ presentPrice(($order->subtotal + $discount)) }}</p>
                                    <p style="font-weight:bold; font-size:18px;">Discount : {{ presentPrice($order->discount) }}</p>
                                    <p style="font-weight:bold; font-size:18px;{{ $order->discount == 0 ? 'display:none;' : 'display:initial;' }}">Discountချပြီးစုစုပေါင်းဈေးနူန်း : {{ presentPrice($order->total) }} </p>
                                    <div style="border-top: 1px solid black; margin:10px 0px;"></div>
                                    <p style="font-weight:bold; font-size:18px;">စုစုပေါင်းဈေးနူန်း : {{ presentPrice($order->total) }}</p>
                                    <p style="font-weight:bold; font-size:18px;">လက်ကျန်ငွေ : {{ presentPrice($balance) }}</p>
                                    <div style="border-top: 1px solid black; margin:10px 0px;"></div>
                                    <p style="font-weight:bold; font-size:18px;">စုစုပေါင်းပေးရန်လက်ကျန်ငွေ : {{ presentPrice(($balance)) }}</p>
                                    <div style="border-top: 1px solid black; margin:10px 0px;"></div>
                                    <h3 style="text-align: center; font-weight:bolder;">(1)လချင်းပေးရန်ငွေ : ({{ presentPrice($oneMonthBalance / 4) }})</h3>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager::generic.delete_confirm') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
<script src="http://doersguild.github.io/jQuery.print/jQuery.print.js"></script> 

<script type="text/javascript">
        
    //<![CDATA[
        jQuery(function($) { 'use strict';
        $("#printObj").find('button').on('click', function() {
            //Print ele4 with custom options
            $("#printObj").print({
                //Use Global styles
                globalStyles : false,
                //Add link with attrbute media=print
                mediaPrint : false,
                //Custom stylesheet
                stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",
                //Print in a hidden iframe
                iframe : true,
                //Don't print this
                noPrintSelector : ".avoid-this",
                //Add this at top
                prepend : "Hello World!!!<br/>",
                //Add this on bottom
                append : "<span><br/>Buh Bye!</span>",
                //Log to console when printing is done via a deffered callback
                deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })
            });
        });
        // Fork https://github.com/sathvikp/jQuery.print for the full list of options
    });
    //]]>
    
</script>
    @if ($isModelTranslatable)
        <script>
            $(document).ready(function () {
                $('.side-body').multilingual();
            });
        </script>
    @endif
    <script>

        var deleteFormAction;
        $('.delete').on('click', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) {
                // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');

            $('#delete_modal').modal('show');
        });

    </script>
@stop
