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
                <h1 class="title">Diary</h1>
            </div>
            <div class="level-right">
                <div class="control is-grouped">
                    <p class="control">
                        <a class="button" href="{{ $links['previous'] }}"><i class="fa fa-arrow-left"></i></a>
                    </p>
                    <p class="control">
                        <a class="button is-white" id="page"><i class="fa fa-fw fa-calendar-o"></i>{{ $links['page'] }}</a>

                        <form id="page-form" action="{{ route('entries.index') }}" method="get" style="display: none;">
                            <input type="text" id="date" name="date" >
                        </form>
                    </p>
                    <p class="control">
                        <a class="button {{ $links['next-disabled'] ? 'is-disabled' : '' }}" href="{{ $links['next'] }}"><i class="fa fa-arrow-right"></i></a>
                    </p>
                    <p class="control">
                        <a class="button is-primary" href="{{ route('entries.create') }}"><i class="fa fa-plus"></i></a>
                    </p>
                </div>
            </div>
        </nav>

        <nav class="pagination is-centered">


            <ul class="pagination-list">

            </ul>
        </nav>

        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Caffeine</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entries as $entry)
                <tr>
                    <td>{{ $entry->product->name }}</td>
                    <td>{{ $entry->quantity }} oz</td>
                    <td>{{ $entry->quantity * $entry->product->caffeine }} mg</td>
                    <td class="has-text-right">
                        <a class="button is-primary is-outlined is-small" href="{{ route('entries.edit', $entry->id) }}">
                            <span>Edit</span>
                            <span class="icon is-small">
                                <i class="fa fa-pencil"></i>
                            </span>
                        </a>

                        <a class="button is-danger is-outlined is-small" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('entry-{{ $entry->id }}').submit();">
                            <span>Delete</span>
                            <span class="icon is-small">
                                <i class="fa fa-times"></i>
                            </span>
                        </a>

                        <form id="entry-{{ $entry->id }}" action="{{ route('entries.destroy', $entry->id) }}" method="post" style="display: none;">
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

@slot('scripts')
    <script>
        new Pikaday({
            field: document.getElementById('date'),
            trigger: document.getElementById('page'),
            defaultDate: new Date('{{ $date }}'),
            maxDate: new Date(),
            onSelect: function() { document.getElementById('page-form').submit() }
        });
    </script>
@endslot

@endcomponent
