<section class="hero-section set-bg" data-setbg="/plateforme/img/bg.jpg">
    <div class="container">
       <div class="hero-text text-white">
    <h2>SKGS - Plateforme de Gestion Scolaire</h2>
    <p>Bienvenue
        @if(Auth::check())
            <span style="color: #d82a4e; font-weight: bold;">
                {{ Auth::user()->sex == 'M' ? 'Monsieur' : 'Madame' }}
               <span style="color: #d82a4e; font-weight: bold; font-size: 2em;"> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
            </span>
        @endif
        sur votre espace enseignant dédié à la saisie et au suivi des notes.<br>
    Enregistrez et gérez facilement les résultats de vos élèves par classe et par matière.</p>
</div>
        {{-- <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <form class="intro-newslatter">
                    <input type="text" placeholder="Name">
                    <input type="text" class="last-s" placeholder="E-mail">
                    <button class="site-btn">Sign Up Now</button>
                </form>
            </div>
        </div> --}}
    </div>
</section>
