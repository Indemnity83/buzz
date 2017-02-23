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
                <a class="button is-primary is-large" href="{{ route('entries.create') }}">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </nav>

        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Caffeine</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entries as $entry)
                <tr>
                    <th>{{ $entry->consumed_at->diffForHumans() }}</th>
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

        {{ $entries->links() }}

    </div>
  </section>

@endcomponent
