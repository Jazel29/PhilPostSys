@echo off
cd /d C:\Users\admin\PhilPostSys
npm run build && start http://192.168.1.172:8000 && php artisan serve --host=192.168.1.172