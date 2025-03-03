
نقوم بفتح المشروع و في منفذ الاوامر نقوم 

1- تثبيت الحزم المطلوبة:composer install

2- إنشاء ملف البيئة(.env):cp .env.example .env

3- توليد مفتاح التطبيق:php artisan key:generate

4- إعداد قاعدة البيانات في ملف .env اذا كنت سوف تستخدم sqlite لا بحاجة لتعديل اي شئ

 
5-إنشاء جداول قاعدة البيانات:php artisan migrate

6- إدخال بيانات تجريبية : php artisan db:seed

7- تشغيل السيرفر المحلي:php artisan serve


