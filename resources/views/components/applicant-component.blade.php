
    <ul class="flex flex-row w-full flex-wrap lg:flex-col gap-5">
        <li class="">

                <a href="{{ isset($applicant) ? route('applicant.profile', ['slug' => $applicant->slug]) : '#' }}" class="group text-blue-primary flex flex-row items-center transition-all duration-300 hover:opacity-75">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="group hover:opacity-75">
                        <path d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H18C18 18.6863 15.3137 16 12 16C8.68629 16 6 18.6863 6 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11Z" fill="#0B2641"/>
                    </svg>
                    <span class="text-base lg:text-lg font-medium ml-2">Страница профиля</span>
                </a>

        </li>
        <li>
            <a href="{{ route('applicant.index') }}" class="group text-blue-primary flex flex-row items-center transition-all duration-300 hover:opacity-75">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="group hover:opacity-75">
                    <path d="M3 6H21V18H3V6ZM2 4C1.44772 4 1 4.44772 1 5V19C1 19.5523 1.44772 20 2 20H22C22.5523 20 23 19.5523 23 19V5C23 4.44772 22.5523 4 22 4H2ZM13 8H19V10H13V8ZM18 12H13V14H18V12ZM10.5 10C10.5 11.3807 9.38071 12.5 8 12.5C6.61929 12.5 5.5 11.3807 5.5 10C5.5 8.61929 6.61929 7.5 8 7.5C9.38071 7.5 10.5 8.61929 10.5 10ZM8 13.5C6.067 13.5 4.5 15.067 4.5 17H11.5C11.5 15.067 9.933 13.5 8 13.5Z" fill="#0B2641"/>
                </svg>
                <span class="text-base lg:text-lg font-medium ml-2">Профиль соискателя</span>
            </a>
        </li>
        <li>
            <a href="{{ $applicant ? route('experience.index') : '#' }}" class="group text-blue-primary flex flex-row items-center transition-all duration-300 hover:opacity-75">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="group hover:opacity-75">
                    <path d="M12.0001 8.5L14.1161 13.5875L19.6085 14.0279L15.4239 17.6125L16.7023 22.9721L12.0001 20.1L7.29777 22.9721L8.57625 17.6125L4.3916 14.0279L9.88403 13.5875L12.0001 8.5ZM12.0001 13.707L11.2615 15.4835L9.34505 15.637L10.8051 16.8883L10.3581 18.759L12.0001 17.7564L13.6411 18.759L13.195 16.8883L14.6541 15.637L12.7386 15.4835L12.0001 13.707ZM8.00005 2V11H6.00005V2H8.00005ZM18.0001 2V11H16.0001V2H18.0001ZM13.0001 2V7H11.0001V2H13.0001Z" fill="#0B2641"/>
                </svg>
                <span class="text-base lg:text-lg font-medium ml-2">Опыт работы</span>
            </a>
        </li>
        <li>
            <a href="{{ $applicant ? route('education.index') : '#' }}" class="group text-blue-primary flex flex-row items-center transition-all duration-300 hover:opacity-75">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="group hover:opacity-75">
                    <path d="M4 11.3333L0 9L12 2L24 9V17.5H22V10.1667L20 11.3333V18.0113L19.7774 18.2864C17.9457 20.5499 15.1418 22 12 22C8.85817 22 6.05429 20.5499 4.22263 18.2864L4 18.0113V11.3333ZM6 12.5V17.2917C7.46721 18.954 9.61112 20 12 20C14.3889 20 16.5328 18.954 18 17.2917V12.5L12 16L6 12.5ZM3.96927 9L12 13.6846L20.0307 9L12 4.31541L3.96927 9Z" fill="#0B2641"/>
                </svg>
                <span class="text-base lg:text-lg font-medium ml-2">Образование</span>
            </a>
        </li>
        <li>
            <a href="{{ $applicant ? route('resume.index') : '#' }}" class="group text-blue-primary flex flex-row items-center transition-all duration-300 hover:opacity-75">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="group hover:opacity-75">
                    <path d="M21.0082 3C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H21.0082ZM20 5H4V19H20V5ZM18 15V17H6V15H18ZM12 7V13H6V7H12ZM18 11V13H14V11H18ZM10 9H8V11H10V9ZM18 7V9H14V7H18Z" fill="#0B2641"/>
                </svg>
                <span class="text-base lg:text-lg font-medium ml-2">Резюме</span>
            </a>
        </li>
        <li>
            <a href="{{ $applicant ? route('message.index') : '#' }}" class="relative group text-blue-primary flex flex-row items-center transition-all duration-300 hover:opacity-75">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="group hover:opacity-75">
                    <path d="M10.0076 2.10365C8.60593 1.64993 7.0823 2.28104 6.41205 3.59294L5.60627 5.17011C5.51053 5.35751 5.35812 5.50992 5.17073 5.60566L3.59355 6.41144C2.28165 7.08169 1.65055 8.60532 2.10426 10.0069L2.64972 11.6919C2.71453 11.8921 2.71453 12.1077 2.64972 12.3079L2.10426 13.9929C1.65055 15.3945 2.28166 16.9181 3.59355 17.5883L5.17073 18.3941C5.35812 18.4899 5.51053 18.6423 5.60627 18.8297L6.41206 20.4068C7.08231 21.7187 8.60593 22.3498 10.0076 21.8961L11.6926 21.3507C11.8928 21.2859 12.1083 21.2859 12.3085 21.3507L13.9935 21.8961C15.3951 22.3498 16.9187 21.7187 17.589 20.4068L18.3948 18.8297C18.4905 18.6423 18.6429 18.4899 18.8303 18.3941L20.4075 17.5883C21.7194 16.9181 22.3505 15.3945 21.8968 13.9929L21.3513 12.3079C21.2865 12.1077 21.2865 11.8921 21.3513 11.6919L21.8968 10.0069C22.3505 8.60531 21.7194 7.08169 20.4075 6.41144L18.8303 5.60566C18.6429 5.50992 18.4905 5.3575 18.3948 5.17011L17.589 3.59294C16.9187 2.28104 15.3951 1.64993 13.9935 2.10365L12.3085 2.6491C12.1083 2.71391 11.8928 2.71391 11.6926 2.6491L10.0076 2.10365ZM8.19308 4.50286C8.41649 4.06556 8.92437 3.8552 9.39156 4.00643L11.0766 4.55189C11.6772 4.74632 12.3239 4.74632 12.9245 4.55189L14.6095 4.00643C15.0767 3.8552 15.5845 4.06556 15.808 4.50286L16.6137 6.08004C16.901 6.64222 17.3582 7.09946 17.9204 7.38668L19.4976 8.19246C19.9349 8.41588 20.1452 8.92375 19.994 9.39095L19.4485 11.076C19.2541 11.6766 19.2541 12.3232 19.4485 12.9238L19.994 14.6088C20.1452 15.076 19.9349 15.5839 19.4976 15.8073L17.9204 16.6131C17.3582 16.9003 16.901 17.3576 16.6137 17.9197L15.808 19.4969C15.5845 19.9342 15.0767 20.1446 14.6095 19.9933L12.9245 19.4479C12.3239 19.2535 11.6772 19.2535 11.0766 19.4479L9.39157 19.9933C8.92437 20.1446 8.41649 19.9342 8.19308 19.4969L7.38729 17.9197C7.10008 17.3576 6.64283 16.9003 6.08065 16.6131L4.50348 15.8073C4.06618 15.5839 3.85581 15.076 4.00705 14.6088L4.5525 12.9238C4.74693 12.3232 4.74693 11.6766 4.5525 11.076L4.00705 9.39095C3.85581 8.92375 4.06618 8.41588 4.50348 8.19246L6.08065 7.38668C6.64283 7.09946 7.10008 6.64222 7.38729 6.08004L8.19308 4.50286ZM6.76009 11.7573L11.0027 15.9999L18.0738 8.92885L16.6596 7.51464L11.0027 13.1715L8.17431 10.343L6.76009 11.7573Z" fill="#0B2641"/>
                </svg>
                <span class="text-base lg:text-lg font-medium ml-2">Отклики и приглашения</span>
                @if($messagesCount)
                    <span class="text-white flex justify-center text-xs/3 items-center w-4 h-4 bg-green-primary rounded-full absolute -top-1.5 -left-1.5">{{ $messagesCount }}</span>
                @endif
            </a>
        </li>
        <li>
            <a href="{{ route('favorite.list') }}" class="relative group text-blue-primary flex flex-row items-center transition-all duration-300 hover:opacity-75">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"  class="group hover:opacity-75">
                    <path d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3ZM12.9339 18.6038C13.8155 18.0485 14.61 17.4955 15.3549 16.9029C18.3337 14.533 20 11.9435 20 9C20 6.64076 18.463 5 16.5 5C15.4241 5 14.2593 5.56911 13.4142 6.41421L12 7.82843L10.5858 6.41421C9.74068 5.56911 8.5759 5 7.5 5C5.55906 5 4 6.6565 4 9C4 11.9435 5.66627 14.533 8.64514 16.9029C9.39 17.4955 10.1845 18.0485 11.0661 18.6038C11.3646 18.7919 11.6611 18.9729 12 19.1752C12.3389 18.9729 12.6354 18.7919 12.9339 18.6038Z" fill="#0B2641"/>
                </svg>
                <span class="text-base lg:text-lg font-medium ml-2">Избранное</span>
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}" class="group text-blue-primary flex flex-row items-center transition-all duration-300 hover:opacity-75">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="group hover:opacity-75">
                    <path d="M4 15H6V20H18V4H6V9H4V3C4 2.44772 4.44772 2 5 2H19C19.5523 2 20 2.44772 20 3V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V15ZM10 11V8L15 12L10 16V13H2V11H10Z" fill="#0B2641"/>
                </svg>
                <span class="text-base lg:text-lg font-medium ml-2">Выйти</span>
            </a>
        </li>
    </ul>


