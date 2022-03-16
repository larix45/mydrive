# mydrive
One file solution for sharing files publically on the public facing server.

## Instalation
### Requirenments:
* public IPv4 adress
* at least 1MB of free disk space (prefarably more, if you want to store any files 😉)
* server to run all this
* Apache or Nginx
* PHP interpreter
* 15 minutes of free time

### Steps for instalation on Ubuntu 20.04 with Apache (other distros or even Windows would be similar, but some locations could be different)
#### **install apache server with command**

` $ sudo apt update && sudo apt install -y apache2 php7.4` 

#### **download this git repository using command**

` $ git clone https://github.com/larix45/mydrive.git` 

#### **create link to your folder with data**

` $ ln -s /home/$USER/Public /var/www/html/public` 

` $ chmod o+r /var/www/html/public`

#### **edit index.php acording to this**

> const server_adress = "http://localhost/";

replacing *localhost* with your IPv4 and change to https if your server supports it (you can create free SSL certyficate with [Let's Encrypt](https://letsencrypt.org)).



## Configuration

It is possible to change apperance by editing theese CSS variables

...

Changing the name of folder with data can be done by replaceing lines 
> const full_file_path = encodeURI(server_adress + **"/public/"** + filename);
> download_link.href = **"/public/"** + filename;
>   echo "\<input type='hidden' id='files' value='".json_encode(array_values(scandir(**"./public"**)))."'>";
>  echo "\<input type='hidden' id='dirs' value='".json_encode(array_values(glob(**"public"** . "/*" , GLOB_ONLYDIR)))."'>"; 


## Usage
type in your IPv4 adress into web browser
viola 😃

## Translation
you can provide transaltion for the entire application by changing theese literals:
*  " ZALOGUJ"                           
*  "POBIERZ PLIK"                    
*  "KOPIUJ LINK"                         
*  "POBIERZ PLIK"                       
*  "Wybierz plik"                       
*  Wybierz plik:
*  'Skopiuj link do schowka'
*  PRZEŚLIJ PLIK
*  "Ta przeglądarka nie obsługuje podglądu, możesz dalej pobać plik."
*  "Twoja przegladarka nie obsługuje odtwarzania tego filmu, możesz go dalej pobrać";
*  "Twoja przegladarka nie obsługuje odtwarzania pliku audio, możesz go dalej pobrać";
*  "Nie można wyświetlić podglądu dla pliku: " + filename + ", możesz go dalej pobrać"
*   alert("Błąd: "+ error);
*   "Plik ''" + filename + "'' nie istnieje, lub nie jest dostępny."
*   Link skopiowany :)
*   title="Pobierz plik na urządzenie"
*   title="Skopiuj link do schowka"
*   Hasło:
*   value="Zaloguj i prześlij pliki"  