<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <script src="/js/app.js" defer></script>
        <link href="/css/app.css" rel="stylesheet">
        <title>Items</title>
    </head>
    <body>
        <div class='container mt-5'>
            <h1 class='font-weight-bold mb-3'>Items Management Page</h1>
            <form action='{{ route('item.store') }}' method='post'>
                @csrf

                <div class="input-group mb-3">
                    <input type="text" class="form-control" name='name' id='item-name' placeholder="Enter an item name and click Add">
                    <div class="input-group-append">
                        <button class='btn btn-sm btn-success' onclick='return addItem()'>Add</button>
                    </div>
                </div>

            </form>

            @if (session('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action='{{route('item.select')}}' method='post' id='form'>
                @csrf

                {{--unselected items--}}
                <div class='row align-items-center'>
                    <div class='col-md-5'>
                        <select class="custom-select overflow-auto" id='selected-item' name='selectedItemId' style='min-height: 20em; max-height: 20em' size="2">
                            @foreach($unselected_items as $item)
                                <option class='p-1' value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{--buttons--}}
                    <div class='col-md-2 text-center my-2'>
                        <button class='btn btn-sm mb-3' onclick='return selectItem()'>
                            <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-arrow-right-square-fill" fill="#38c172" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm2.5 8.5a.5.5 0 0 1 0-1h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5z"/>
                            </svg>
                        </button>
                        <br/>
                        <button class='btn btn-sm' onclick='return unselectItem()'>
                            <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-arrow-left-square-fill" fill="#e3342f" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm9.5 8.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z"/>
                            </svg>
                        </button>
                    </div>
                    {{--selected items--}}
                    <div class='col-md-5'>
                        <select class="custom-select overflow-auto" id='unselected-item' name='unselectedItemId' style='min-height: 20em; max-height: 20em' size="2">
                            @foreach($selected_items as $item)
                                <option class='p-1' value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <div class="toast" role="alert" aria-live="assertive" data-autohide="true" data-delay='2500' aria-atomic="true">
                <div class="toast-header">
                    <strong class="mr-auto text-danger">ERROR</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    {{--fillable in js--}}
                </div>
            </div>
        </div>
    </body>
</html>

<script type='text/javascript'>
    function selectItem() {
        if ($('#selected-item').val() == null) {
            $('.toast-body').text('Please select an item from the left menu first')
            $('.toast').toast('show')
            return false
        }
        $('#form').attr('action', 'select-item')
    }

    function unselectItem() {
        if ($('#unselected-item').val() == null) {
            $('.toast-body').text('Please select an item from the right menu first')
            $('.toast').toast('show')
            return false
        }
        $('#form').attr('action', 'unselect-item')
    }

    function addItem() {
        if ($('#item-name').val() === '') {
            $('.toast-body').text('Please enter a name for the item')
            $('.toast').toast('show')
            return false
        }
    }
</script>

<style type='text/css'>
    .toast {
        font-weight: bold;
        position: fixed;
        top: 1em;
        left: 50%;
        transform: translateX(-50%);
    }
</style>
