@component('layouts.app')

<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                Personal Caffeine Diary
            </h1>
            <h2 class="subtitle">
                Your daily buzz!
            </h2>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">

        <nav class="level">
            <div class="level-left">
                <h1 class="title">Record Entry</h1>
            </div>
            <div class="level-right">
                &nbsp;
            </div>
        </nav>

        @if( count($errors) )
        <div class="notification is-warning">
            <ul>
                @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="post" action="{{ route('entries.store') }}">
            {{ csrf_field() }}

                {{-- quantity --}}
                <label class="label">Quantity</label>
                <p class="control has-addons">
                    <input class="input is-expanded" type="text" name="quantity" value="{{ old('quantity') }}">
                    <span class="select">
                        <select name="caffeine_units">
                            <option value="oz">oz</option>
                        </select>
                    </span>
                </p>

                {{-- product_id --}}
                <label class="label">Product</label>
                <p class="control">
                    <span class="select">
                        <select class="select" name="product_id">
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" @if($product->id == old('product_id')) selected="selected" @endif>{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </span>
                </p>

                {{-- consumed_at --}}
                <label class="label">Consumed</label>
                <p class="control">
                    <input id="consumed_at" class="input" type="datetime" name="consumed_at" value="{{ old('consumed_at', \Carbon\Carbon::now()) }}">
                </p>

                {{-- Submit --}}
                <div class="control is-grouped">
                    <p class="control is-horizontal">
                        <button class="button is-primary" type="submit">Submit</button>
                    </p>
                    <p class="control">
                        <a class="button is-link" href="{{ back() }}">Cancel</a>
                    </p>
                </div>

        </form>

    </div>
  </section>


@slot('scripts')
    <script>
        new Pikaday({
            field: document.getElementById('consumed_at'),
            maxDate: new Date()
        });
    </script>
@endslot

@endcomponent

