<footer class="footer bg-blue-primary w-full py-10 lg:py-15  mt-10 lg:mt-20">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row justify-start gap-4">
            <div class="w-full md:w-4/12 flex flex-col justify-start md:justify-between">
                <a href="/">
                    <img src="{{ asset('assets/img/footer-logo.svg') }}" alt="JobHunter" />
                </a>
                <p class="text-white text-[13px] mt-3 lg:mt-0">© 2005-{{ date('Y') }}. Все права защищены.</p>
            </div>
            <div class="w-full md:w-4/12 flex flex-col">
                <ul>
                    <li><a href="{{ route('page.show', ['slug' => 'zashchita-personalnyh-dannyh']) }}" class="text-white">Персональные данные</a></li>
                    <li class=""><a href="{{ route('page.show', ['slug' => 'polzovatelskoe-soglashenie']) }}" class="text-white" >Пользовательское соглашение</a></li>
                    <li><a href="{{ route("hr.search") }}" class="text-white">Поиск по HR</a></li>
                    <li><a href="{{ route("employer.search") }}" class="text-white">Поиск по работодателям</a></li>
                    <li><a href="" class="text-white">Карта сайта</a></li>
                </ul>
            </div>
            <div class="w-full md:w-4/12 flex flex-col justify-between">
                <p class="text-white">По всем вопросам обращайтесь:<br/>
                    <a href="mailto:info@jobhunter.ru" class="text-white" >info@jobhunter.ru</a></p>
                <p><a href="#" class="text-white" ><img src="{{ asset('assets/img/telegram.svg') }}" width="24" height="24" alt=""></a></p>
            </div>
        </div>
    </div>
</footer>
