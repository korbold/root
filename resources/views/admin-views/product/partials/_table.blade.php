@foreach($foods as $key=>$food)
    <tr>
        <td>{{$key+1}}</td>
        <td>
            <a class="media align-items-center"
                href="{{ route('admin.food.view', [$food['id']]) }}">
                <img class="avatar avatar-lg mr-3"
                    src="{{ asset('storage/app/public/product') }}/{{ $food['image'] }}"
                    onerror="this.src='{{ asset('public/assets/admin/img/100x100/food-default-image.png') }}'"
                    alt="{{ $food->name }} image">
                <div class="media-body">
                    <h5 class="text-hover-primary mb-0">
                        {{ Str::limit($food['name'], 20, '...') }}</h5>
                </div>
            </a>
        </td>
        <td>
            {{ Str::limit($food->category, 20, '...') }}
        </td>
        <td>
            {{ Str::limit($food->restaurant ? $food->restaurant->name : __('messages.Restaurant deleted!'), 20, '...') }}
        </td>
        <td>{{ \App\CentralLogics\Helpers::format_currency($food['price']) }}</td>
        <td>
            <label class="toggle-switch toggle-switch-sm"
                for="stocksCheckbox{{ $food->id }}">
                <input type="checkbox"
                    onclick="location.href='{{ route('admin.food.status', [$food['id'], $food->status ? 0 : 1]) }}'"
                    class="toggle-switch-input" id="stocksCheckbox{{ $food->id }}"
                    {{ $food->status ? 'checked' : '' }}>
                <span class="toggle-switch-label">
                    <span class="toggle-switch-indicator"></span>
                </span>
            </label>
        </td>
        <td>
            <div class="btn--container justify-content-center">
                <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                    href="{{ route('admin.food.edit', [$food['id']]) }}"
                    title="{{ __('messages.edit') }} {{ __('messages.food') }}"><i
                        class="tio-edit"></i>
                </a>
                <a class="btn btn-sm btn--warning btn-outline-warning action-btn" href="javascript:"
                    onclick="form_alert('food-{{ $food['id'] }}','{{ __('messages.Want_to_delete_this_item') }}')"
                    title="{{ __('messages.delete') }} {{ __('messages.food') }}"><i
                        class="tio-delete-outlined"></i>
                </a>
            </div>
            <form action="{{ route('admin.food.delete', [$food['id']]) }}" method="post"
                id="food-{{ $food['id'] }}">
                @csrf @method('delete')
            </form>
        </td>
    </tr>
@endforeach
