@extends('layouts.app')

@section('content')
<b-container>
    <b-row align-h="center">
       
        <b-col cols="8">
            <b-card title="Inicio de sesión" class="my-3">
                

                @if($errors->any())
                    <b-alert show variant="danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </b-alert>
                @else
                    <b-alert show>Ingresa tus datos</b-alert>
                @endif
                
                <b-form method="POST" action="{{ route('login') }}">
                    @csrf

                    <b-form-group
                        label="Correo electrónico"
                        label-for="email"
                        >
                        <b-form-input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Ingresa tu correo electrónico"
                            required autofocus
                            value="{{old('email')}}">
                        </b-form-input>
                        @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </b-form-group>

                    <b-form-group
                        label="Contraseña"
                        label-for="password"
                        >
                        <b-form-input
                            type="password"
                            id="password"
                            name="password"
                            required>
                        </b-form-input>
                        @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </b-form-group>
                    <b-form-group>    
                        <b-form-checkbox
                            name="remember"
                            {{ old('remember') ? 'checked="true"' : '' }}
                            >
                            Recordar sesión
                        </b-form-checkbox>
                    </b-form-group>
            
                    <b-button type="submit" variant="primary">Ingresar</b-button>
                    

                    @if (Route::has('password.request'))
                        <b-button href="{{ route('password.request') }}" variant="link">¿Olvidaste tu contraseña?</b-button>
                    @endif
                    

                
                </b-form>
            </b-card>

            
        </b-col>
        

    </b-row>

</b-container>
@endsection
