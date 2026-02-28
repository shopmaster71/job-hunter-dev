<footer class="footer bg-blue-primary w-full py-10 lg:py-15  mt-10 lg:mt-20">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row justify-start gap-4">
            <div class="w-full md:w-4/12 flex flex-col justify-start md:justify-between">
                <a href="/">
                    <img src="{{ asset('assets/img/footer-logo.svg') }}" alt="JobHunter" />
                </a>
                <p class="text-white text-[13px] mt-3 lg:mt-0">© 2005-2025. Все права защищены.</p>
            </div>
            <div class="w-full md:w-4/12 flex flex-col">
                <ul>
                    <li><a href="" class="text-white">Персональные данные</a></li>
                    <li class="py-1 lg:py-5"><a href="" class="text-white" >Пользовательское соглашение</a></li>
                    <li><a href="" class="text-white">Карта сайта</a></li>
                    <li><a href="{{ route('clear.all') }}" class="text-red-500">Очистить кэш</a></li>
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
