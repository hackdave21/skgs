@extends('frontend.layout')

@section('title', 'Accueil')

@section('content')

    <!-- matières section -->
    <section class="categories-section spad">
        <div class="container">
            <div class="section-title">
                <h2>Mes Matières Enseignées</h2>
                <p>Découvrez les différentes matières que j'enseigne et les classes dans lesquelles j'interviens.</p>
            </div>
            <div class="row">
                @if (auth()->user()->subjects && auth()->user()->subjects->count() > 0)
                    @foreach (auth()->user()->subjects->unique('id') as $subject)
                        <!-- matière -->
                        <div class="col-lg-4 col-md-6">
                            <div class="categorie-item">
                                <div class="ci-thumb">
                                    <i class="fa fa-file-text"
                                        style="font-size: 48px; color: #007bff; display: flex; justify-content: center; align-items: center; height: 100%; min-height: 200px;"></i>
                                </div>
                                <div class="ci-text">
                                    <h5>{{ $subject->name }}</h5>
                                    <p>{{ $subject->description ?? 'Matière enseignée avec passion et expertise' }}</p>
                                    <span>
                                        @php
                                            // Récupérer les classes pour cette matière spécifique
                                            $classesForSubject = auth()
                                                ->user()
                                                ->schoolClasses()
                                                ->wherePivot('subject_id', $subject->id)
                                                ->get();
                                        @endphp
                                        @if ($classesForSubject->count() > 0)
                                            {{ $classesForSubject->count() }}
                                            {{ $classesForSubject->count() > 1 ? 'Classes' : 'Classe' }}
                                        @else
                                            Aucune classe assignée
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="text-center">
                            <h4>Aucune matière assignée</h4>
                            <p>Contactez l'administration pour l'assignation de matières.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- matières section end -->


    <!-- search section -->
    <section class="search-section">
        <div class="container">
            <div class="search-warp">
                <div class="section-title text-white">
                    <h2>Rechercher une matière</h2>
                </div>
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <!-- search form -->
                        <form class="course-search-form">
                            <input type="text" placeholder="matière">
                            {{-- <input type="text" class="last-m" placeholder="Category"> --}}
                            <button class="site-btn">Recherche</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- search section end -->


    <!-- course section -->
    @include("frontend.matiere")
    <!-- course section end -->


    <!-- signup section -->
    <section class="signup-section spad">
        <div class="signup-bg set-bg" data-setbg="/plateforme/img/signup-bg.jpg"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="signup-warp">
                        <div class="section-title text-white text-left">
                            <h2>Signalement à l'administration</h2>
                            <p>Utilisez ce formulaire pour soumettre vos doléances, suggestions ou signaler un problème
                                concernant vos soucis sur la platforme.</p>
                        </div>
                        <!-- formulaire de signalement -->
                        <form class="signup-form">
                            <input type="text" placeholder="Votre nom">
                            <input type="text" placeholder="Votre email académique">
                            <input type="text" placeholder="Votre téléphone">
                            <textarea placeholder="Décrivez votre demande..."></textarea>
                            <label for="v-upload" class="file-up-btn">Joindre un document</label>
                            <input type="file" id="v-upload">
                            <button class="site-btn">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- signup section end -->

@endsection
