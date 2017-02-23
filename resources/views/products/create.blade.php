@component('layouts.app')

<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Caffeine Database
      </h1>
      <h2 class="subtitle">
        All Things Caffienated!
      </h2>
    </div>
  </div>
</section>

<section class="section">
    <div class="container">

        <nav class="level">
            <div class="level-left">
                <h1 class="title">New Product</h1>
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

        <form method="post" action="{{ route('products.store') }}">
            {{ csrf_field() }}

            {{-- Name --}}
            <label class="label">Name</label>
            <p class="control">
                <input class="input" type="text" name="name" value="{{ old('name') }}">
            </p>

            {{-- Caffeine --}}
            <label class="label">Caffeine</label>
            <p class="control has-addons">
                <input class="input is-expanded" type="text" name="caffeine" value="{{ old('caffeine') }}">
                <span class="select">
                    <select name="caffeine_units">
                        <option value="mg">mg / oz</option>
                    </select>
                </span>
            </p>

            {{-- Submit --}}
            <div class="control is-grouped">
                <p class="control">
                    <button class="button is-primary" type="submit">Submit</button>
                </p>
                <p class="control">
                    <a class="button is-link" href="{{ back() }}">Cancel</a>
                </p>
            </div>
        </form>

    </div>
  </section>

@endcomponent
