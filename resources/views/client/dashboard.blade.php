<!-- resources/views/client/dashboard.blade.php -->
@extends('layouts.client-dashboard')

@section('content')
<div class="services-section">
    <div class="section-header">
        <h2>Our Veterinary Services</h2>
        <p>Comprehensive care for your beloved pets</p>
    </div>
    
    <div class="services-grid">
        <!-- Consultation Card -->
        <div class="service-card" data-service="consultation">
            <div class="service-icon">
                <i class="fas fa-stethoscope"></i>
            </div>
            <h3>Consultation</h3>
            <p>Professional examination and health assessment for your pet</p>
        </div>
        
        <!-- Vaccination Card -->
        <div class="service-card" data-service="vaccination">
            <div class="service-icon">
                <i class="fas fa-syringe"></i>
            </div>
            <h3>Vaccination</h3>
            <p>Essential vaccines to protect your pet from common diseases</p>
        </div>
        
        <!-- Grooming Card -->
        <div class="service-card" data-service="grooming">
            <div class="service-icon">
                <i class="fas fa-cut"></i>
            </div>
            <h3>Grooming</h3>
            <p>Professional grooming services to keep your pet clean and healthy</p>
        </div>
        
        <!-- Deworming Card -->
        <div class="service-card" data-service="deworming">
            <div class="service-icon">
                <i class="fas fa-bug"></i>
            </div>
            <h3>Deworming</h3>
            <p>Treatment to eliminate internal parasites from your pet</p>
        </div>
        
        <!-- Laboratory Test Card -->
        <div class="service-card" data-service="laboratory test">
            <div class="service-icon">
                <i class="fas fa-flask"></i>
            </div>
            <h3>Laboratory Test</h3>
            <p>Diagnostic tests to assess your pet's health condition</p>
        </div>
        
        <!-- Surgery Card -->
        <div class="service-card" data-service="surgery">
            <div class="service-icon">
                <i class="fas fa-procedures"></i>
            </div>
            <h3>Surgery</h3>
            <p>Surgical procedures performed by our expert veterinarians</p>
        </div>
        
        <!-- Dental Care Card -->
        <div class="service-card" data-service="dental care">
            <div class="service-icon">
                <i class="fas fa-tooth"></i>
            </div>
            <h3>Dental Care</h3>
            <p>Professional dental cleaning and oral health services</p>
        </div>
        
        <!-- Emergency Care Card -->
        <div class="service-card" data-service="emergency care">
            <div class="service-icon">
                <i class="fas fa-ambulance"></i>
            </div>
            <h3>Emergency Care</h3>
            <p>Immediate medical attention for critical situations</p>
        </div>
    </div>
</div>
@endsection