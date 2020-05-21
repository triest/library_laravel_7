<?php

    use App\Builders\BookBuilder;
    use Illuminate\Database\Seeder;

    class BookSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            //

            $bookBuilder = new BookBuilder();
            $bookBuilder->setTitle("Дюна: Дом Атрейдесов");
            $author = new \App\Author();
            $author->first_name = "Брайан";
            $author->last_name = "Герберт";
            $author->save();
            $bookBuilder->addAuthor($author);

            $author = new \App\Author();
            $author->first_name = "Кевин";
            $author->last_name = " Дж Андерсон";
            $author->save();
            $bookBuilder->addAuthor($author);
            $bookBuilder->save();

            $bookBuilder = new BookBuilder();
            $bookBuilder->setTitle('Запад Эдема');

            $author = new \App\Author();;
            $author->first_name = "Гарри";
            $author->last_name = "Гаррисон";
            $author->save();
            $bookBuilder->addAuthor($author);
            $bookBuilder->save();


        }
    }
