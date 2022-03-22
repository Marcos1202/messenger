@extends('layouts.app')

@section('content')
<b-row align-h="center"> 
    <b-col cols="8">
        <b-card title="Registro" class="my-3">
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

            <b-form method="POST" action="{{ route('register') }}">
                @csrf

                <b-form-group
                    label="Nombre"
                    label-for="name"
                    >
                    <b-form-input
                        type="text"
                        id="name"
                        name="name"
                        required autofocus
                        value="{{old('name')}}">
                    </b-form-input>
                </b-form-group>


                <b-form-group
                    label="Correo electrónico"
                    label-for="email"
                    >
                    <b-form-input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Ingresa tu correo electrónico"
                        required 
                        value="{{old('email')}}">
                    </b-form-input>
                </b-form-group>

                <b-form-group
                    label="Contraseña"
                    label-for="password"
                    >
                    <b-form-input
                        type="password"
                        id="password"
                        name="password"
                        required >
                    </b-form-input>
                   
                </b-form-group>

                <b-form-group
                    label="Confirma tu contraseña"
                    label-for="password_confirmation"
                    >
                    <b-form-input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required>
                    </b-form-input>
                   
                </b-form-group>
                
        
                <b-button type="submit" variant="primary">Registrarse</b-button>
                

                
                

            
            </b-form>
        </b-card>
    </b-col>
</b-row>

@endsection
