# 環境構築　　

## Docker作成  
1. git clone git@github.com:miho-85-ux/mogitate.git 
2. docker-compose up -d --build  

## Laravel環境構築  
1. docker-compose exec php bash  
2. composer install  
3. cp .env.example .env  
    .env.exampleファイルから.envファイルを作成し、環境変数を変更  
4. php artisan key:generate  
5. php artisan migrate  
6. php artisan db:seed  

# 使用技術
* PHP:8.1.33
* Lravel:8.83.8
* MySQL:8.0.26
* nginx:1.21.1

# 開発環境
* お問い合わせフォーム:http://localhost 
* phpmyadmin:http://localhost:8080

# ER図添付  
 [ER図]

<img src="ER.drawio.png">
