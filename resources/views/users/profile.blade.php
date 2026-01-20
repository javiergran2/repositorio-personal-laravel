@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Mi Cuenta</h5>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="bi bi-person-circle" style="font-size: 4rem; color: #6c757d;"></i>
                </div>
                <h4>{{ $user->name }}</h4>
                <p>{{ $user->email }}</p>
                {!! $user->getStatusBadge() !!}
                {!! $user->getMembershipBadge() !!}
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Información Personal</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">DNI/NIE:</dt>
                    <dd class="col-sm-8">{{ $user->dni ?? 'No registrado' }}</dd>
                    
                    <dt class="col-sm-4">Teléfono:</dt>
                    <dd class="col-sm-8">{{ $user->phone }}</dd>
                    
                    <dt class="col-sm-4">Dirección:</dt>
                    <dd class="col-sm-8">{{ $user->address }}</dd>
                    
                    <dt class="col-sm-4">Fecha Nacimiento:</dt>
                    <dd class="col-sm-8">{{ $user->birth_date->format('d/m/Y') }} ({{ $user->getAge() }} años)</dd>
                    
                    <dt class="col-sm-4">Membresía:</dt>
                    <dd class="col-sm-8">
                        {{ $user->membership_type == 'premium' ? 'Premium' : 'Básica' }}
                        @if($user->membership_expires_at)
                            <br>
                            <small class="text-muted">
                                Expira: {{ $user->membership_expires_at->format('d/m/Y') }}
                                @if(!$user->hasActiveMembership())
                                    <span class="badge bg-warning">Expirada</span>
                                @endif
                            </small>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-4">Saldo:</dt>
                    <dd class="col-sm-8">
                        <strong class="text-success">€{{ number_format($user->balance, 2) }}</strong>
                    </dd>
                    
                    <dt class="col-sm-4">Alquileres máx:</dt>
                    <dd class="col-sm-8">{{ $user->max_rentals }} simultáneos</dd>
                </dl>
                
                <div class="d-flex justify-content-end">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Editar Perfil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection