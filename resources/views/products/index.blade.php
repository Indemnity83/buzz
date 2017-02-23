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
                <h1 class="title">Products</h1>
            </div>
            <div class="level-right">
                <a class="button is-primary is-large" href="{{ route('products.create') }}">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </nav>

        <table class="table">
            <thead>
                <tr>
                    <th><abbr title="Identification">Id</abbr></th>
                    <th>Name</th>
                    <th>Caffeine</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <th>{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->caffeine }} mg / oz</td>
                    <td class="has-text-right">
                        <a class="button is-primary is-outlined is-small" href="{{ route('products.edit', $product->id) }}">
                            <span>Edit</span>
                            <span class="icon is-small">
                                <i class="fa fa-pencil"></i>
                            </span>
                        </a>

                        <a class="button is-danger is-outlined is-small" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('product-{{ $product->id }}').submit();">
                            <span>Delete</span>
                            <span class="icon is-small">
                                <i class="fa fa-times"></i>
                            </span>
                        </a>

                        <form id="product-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="post" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
  </section>

@endcomponent
