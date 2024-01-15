<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-gray-100 dark:bg-gray-800 overflow-hidden p-5 shadow-xl sm:rounded-lg">
                <p class="text-lg font-bold">
                    Welcome to my About page! Here, I'm going to list the recources I used to create this project.
                </p>
                <br/>
                <p>
                    I would like to acknowledge the following resources:
                    <ul>
                        <li>
                            In the beginning, I used this <a href="https://jetstream.laravel.com/installation.html" class="text-blue-400 hover:text-blue-500 hover:underline">Laravel tutorial</a> to set the basis for my project.
                        </li>
                            As for the profilepage, I tried to write the code for it myself and used <a href="https://chat.openai.com" class="text-blue-400 hover:text-blue-500 hover:underline">ChatGPT</a> here and there to help me with the code. I also used it in different parts of the project for small things, repeatetive things or when I got stuck. 
                        </li>
                        <li>
                            For the posts in the blog, I followed this <a href="https://kinsta.com/blog/laravel-blog/" class="text-blue-400 hover:text-blue-500 hover:underline">kinsta tutorial</a> on how to make a blog, but I retouched the code to save the images of the post in the database instead of just locally.
                        </li>
                        <li>
                            While creating the FAQ page, I used  <a href="https://github.com/NoumanAhmad448/Laravel-online-videos-based-learning-system/tree/master" class="text-blue-400 hover:text-blue-500 hover:underline">NoumanAhmad448's code</a> as inspiration. Nouman created a laravel online video based learning system and has a FAQ page as well.
                        </li>
                        <li>
                            I used this <a href="https://www.youtube.com/playlist?list=PL6tf8fRbavl2JgMTNY2a6PKtQgKZR362n" class="text-blue-400 hover:text-blue-500 hover:underline">Laravel tutorial</a> to learn how to create a contact form, more specifically videos <a href=" hover:text-blue-500 hover:underline" class="text-blue-400 hover:text-blue-500 hover:underline">38</a> and <a href="https://www.youtube.com/watch?v=Y-iNNti_rRg&list=PL6tf8fRbavl2JgMTNY2a6PKtQgKZR362n&index=39" class="text-blue-400 hover:text-blue-500 hover:underline">39</a>.
                        <li>
                        <li>
                            Ofcourse, I used <a href="https://tailwindcss.com" class="text-blue-400 hover:text-blue-500 hover:underline">Tailwind</a> for the layout of the pages.
                        </li>
                    </ul>
                </p>
                <br/>
                <p>
                    For more information, check out our <a href="{{ route('contact.show') }}" class="text-blue-400 hover:text-blue-500 hover:underline">Contact</a> page.
                </p>
                <br/>
                <p>
                    How to run the project:
                </p>
                <ul>
                    <li>
                        To run the project, open the terminal in VS Code or in your terminal in the folder where your project is located. Run the command `npm install` to install the needed files or ensure that you have them, then run `npm run dev`. Keep it running and open a different terminal and go to the same location as the first terminal.
                    </li>
                    <li>
                        Here we are going to set the database connection. Open xampp and start your Apache and mySQL, then go back to your terminal and run `php artisan migrate:fresh --seed`. If it refuses to migrate because it didn't find the database "laraveldb", run the migration and seeding steps seperatly as follows:
                        <br>
                        First run `php artisan migrate`, and second run `php artisan db:seed`.
                        <br>
                        This would solve your problem.
                    </li>
                    <li>
                        Finally, when that is all set we can run the project. In your terminal run the following command: php artisan serve and open the link you get.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
