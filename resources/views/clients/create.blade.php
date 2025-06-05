@extends('layouts.app')

@section('page_name', __('clients.create_client'))
@section('content')
<div class="container mt-4 {{ $textAlign }}">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header {{ $textAlign }}">{{ __('clients.create_new_client') }}</div>
        <div class="card-body">
          <form action="{{ route('clients.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('clients.client_name') }}</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required placeholder="{{ __('clients.placeholders.enter_client_name') }}">
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="country" class="form-label">{{ __('clients.client_country') }}</label>
                <input type="text" name="country" class="form-control" id="country" value="{{ old('country') }}" placeholder="{{ __('clients.placeholders.enter_client_country') }}">
              </div>
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('clients.type') }}</label>
                <select name="type" id="type" class="form-control" >
                  <option value="" selected disabled>{{__('clients.select_type')}}</option>
                  <option value="customer">{{__('clients.customer')}}</option>
                  <option value="lead" >{{__('clients.lead')}}</option>
                  <option value="prospect" >{{__('clients.prospect')}}</option>
                  <option value="prospect" >{{__('clients.other')}}</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
              <label for="email" class="form-label">{{ __('clients.email') }}</label>
              <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required placeholder="{{ __('clients.placeholders.enter_email') }}">
              </div>
              <div class="col-md-6 mb-3">
              <label for="phone" class="form-label">{{ __('clients.phone') }}</label>
              <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}" placeholder="{{ __('clients.placeholders.enter_phone') }}">
              </div>
            </div>

            <!-- WhatsApp Fields -->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="whatsapp_phone" class="form-label">
                  <i class="fab fa-whatsapp text-success me-1"></i>
                  {{ __('whatsapp.whatsapp_phone') }}
                </label>
                <input type="text" name="whatsapp_phone" class="form-control" id="whatsapp_phone" value="{{ old('whatsapp_phone') }}" placeholder="{{ __('clients.placeholders.enter_whatsapp_phone') }}">
              </div>
              <div class="col-md-6 mb-3 d-flex align-items-end">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" name="whatsapp_notifications" id="whatsapp_notifications" value="1" {{ old('whatsapp_notifications') ? 'checked' : '' }}>
                  <label class="form-check-label" for="whatsapp_notifications">
                    <i class="fab fa-whatsapp text-success me-1"></i>
                    {{ __('whatsapp.whatsapp_notifications') }}
                  </label>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">{{ __('clients.address') }}</label>
              <textarea name="address" class="form-control" id="address" rows="2" placeholder="{{ __('clients.placeholders.enter_address') }}">{{ old('address') }}</textarea>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
              <label for="state" class="form-label">{{ __('clients.state') }}</label>
              <input type="text" name="state" class="form-control" id="state" value="{{ old('state') }}" placeholder="{{ __('clients.placeholders.enter_state') }}">
              </div>
              <div class="col-md-6 mb-3">
              <label for="city" class="form-label">{{ __('clients.city') }}</label>
              <input type="text" name="city" class="form-control" id="city" value="{{ old('city') }}" placeholder="{{ __('clients.placeholders.enter_city') }}">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="created_at" class="form-label">{{ __('app.created_at') }}</label>
                <input type="date" name="created_at" class="form-control" id="created_at" value="{{ old('created_at' ) }}">
              </div>
              <div class="col-md-6 mb-3">
                <label for="last_activity" class="form-label">{{ __('clients.last_activity') }}</label>
                <input type="date" name="last_activity" class="form-control" id="last_activity" value="{{ old('last_activity') }}">
              </div>
            </div>



            {{-- Make meals Selector --}}
            {{-- <div class="mb-3">
              <label class="form-label">{{ __('meals.meals') }}</label>
              <div class="row">
              @foreach ($meals as $meal)
                <div class="col-md-4 mb-2">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="meals[]" value="{{ $meal->id }}" id="meal_{{ $meal->id }}">
                  <label class="form-check-label" for="meal_{{ $meal->id }}">
                  {{ $meal->name }}
                  </label>
                </div>
                </div>
              @endforeach
              </div>
            </div> --}}

            <div class="mb-3">
              <label for="notes" class="form-label">{{ __('clients.notes') }}</label>
              <textarea name="notes" class="form-control" id="notes" rows="2" placeholder="{{ __('clients.placeholders.enter_notes') }}">{{ old('notes') }}</textarea>
            </div>

            <div class="mb-6">
              <label for="profile_picture" class="form-label">{{ __('clients.profile_picture') }}</label>
              <input type="file" name="profile_picture" class="form-control" id="profile_picture" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary {{ $isRtl ? 'ms-2' : 'me-2' }}">{{ __('clients.create_client') }}</button>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">{{ __('app.cancel') }}</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
