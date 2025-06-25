@extends('frontend.layout')

@section('title', 'Toutes les classes')

@section('content')

<section class="course-section spad" id="classe">
        <div class="container">
            <div class="section-title mb-0">
                <h2>Mes Classes par Matière</h2>
                <p>Découvrez les différentes classes dans lesquelles j'interviens pour chaque matière que j'enseigne.</p>
            </div>
        </div>
        <div class="course-warp">
            <ul class="course-filter controls">
                <li class="control active" data-filter="all">Toutes les matières</li>
                @if (auth()->user()->subjects && auth()->user()->subjects->count() > 0)
                    @foreach (auth()->user()->subjects->unique('id') as $subject)
                        <li class="control" data-filter=".subject-{{ $subject->id }}">{{ $subject->name }}</li>
                    @endforeach
                @endif
            </ul>
            <div class="row course-items-area">
                @if (auth()->user()->subjects && auth()->user()->subjects->count() > 0)
                    @foreach (auth()->user()->subjects->unique('id') as $subject)
                        @php
                            // Récupérer les classes pour cette matière spécifique
                            $classesForSubject = auth()
                                ->user()
                                ->schoolClasses()
                                ->wherePivot('subject_id', $subject->id)
                                ->get();
                        @endphp
                        @if ($classesForSubject->count() > 0)
                            @foreach ($classesForSubject as $class)
                                <div class="mix col-lg-3 col-md-4 col-sm-6 subject-{{ $subject->id }}">
                                    <a href="{{ route('teacher.class.students', ['class' => $class->id, 'subject' => $subject->id]) }}"
                                        class="course-item-link">
                                        <div class="course-item">
                                            <div class="course-thumb"
                                                style="background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; height: 200px;">
                                                <i class="fa fa-graduation-cap"
                                                    style="font-size: 48px; color: #007bff;"></i>
                                            </div>
                                            <div class="course-info">
                                                <div class="course-text">
                                                    <h5>{{ $class->name }}</h5>
                                                    <p>{{ $class->description ?? 'Classe où j\'enseigne ' . $subject->name }}
                                                    </p>
                                                    <div class="students">
                                                        @php
                                                            $studentCount = $class->students
                                                                ? $class->students->count()
                                                                : 0;
                                                        @endphp
                                                        {{ $studentCount }} {{ $studentCount > 1 ? 'Élèves' : 'Élève' }}
                                                    </div>
                                                </div>
                                                <div class="course-author">
                                                    <div class="ca-pic"
                                                        style="width: 40px; height: 40px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fa fa-book" style="color: white; font-size: 16px;"></i>
                                                    </div>
                                                    <p>{{ $subject->name }}, <span>Matière</span></p>
                                                </div>
                                            </div>
                                        </div></a>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="text-center">
                            <h4>Aucune classe assignée</h4>
                            <p>Contactez l'administration pour l'assignation de classes.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>


@endsection
