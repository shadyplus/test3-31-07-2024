<?php

// Default language
$language = 'en';

// Check if the browser's language preference is available
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    // Extract the first language preference
  $browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

    // Supported languages
  $supportedLanguages = ['ar', 'az', 'zh', 'cs', 'de', 'en', 'es', 'fr', 'he', 'hu', 'id', 'it', 'ja', 'kk', 'my', 'nl', 'pl', 'pt', 'ro', 'ru', 'sv', 'sk', 'tr', 'uk', 'vi', 'lv', 'lt', 'el', 'sr', 'bn', 'ko', 'th', 'tl'];

    // Set language if it's supported
  if (in_array($browserLang, $supportedLanguages)) {
    $language = $browserLang;
  }
}

$messages = [
    'ru' => [
        "Спасибо!", 
        "Ваш заказ оформлен и принят нашей командой.",
        "ВНИМАНИЕ!",
        "В БЛИЖАЙШЕЕ ВРЕМЯ ВАМ ПОЗВОНИТ НАШ СПЕЦИАЛИСТ!",
        "Пожалуйста следите за телефоном и ",
        "не пропустите звонок!",
        "Оставьте, пожалуйста, свой адрес электронной почты, и мы вышлем Вам подробную инструкцию по использованию нашей продукции!",
        "Оставив свой Email, вы получите скидку на следующие заказы!",
        "Детали акции будут в письме.",
        "Пожалуйста, введите действительный адрес электронной почты.",
        "Спасибо! Инструкции будут отправлены на вашу электронную почту в ближайшее время."
    ],
    'ar' => [
        "شكرا!", 
        "تم استلام طلبك من قبل فريقنا.",
        "تنبيه!",
        "سيتصل بك أخصائيونا قريبًا!",
        "يرجى متابعة هاتفك و",
        "لا تفوت المكالمة!",
        "يرجى ترك عنوان بريدك الإلكتروني وسنرسل لك إرشادات مفصلة حول كيفية استخدام منتجاتنا!",
        "بترك بريدك الإلكتروني، ستحصل على خصم على الطلبات القادمة!",
        "ستكون تفاصيل العرض في البريد الإلكتروني.",
        "يرجى إدخال عنوان بريد إلكتروني صالح.",
        "شكرا! سيتم إرسال الإرشادات إلى بريدك الإلكتروني قريبًا."
    ],
    'az' => [
        "Təşəkkürlər!", 
        "Sifarişiniz qəbul edildi və komandamız tərəfindən işlənir.",
        "DİQQƏT!",
        "TEZLIKLƏ MÜTƏXƏSSISLƏRIMIZ SIZINLƏ ƏLAQƏ SAXLAYACAQ!",
        "Xahiş edirik telefonunuzu nəzarətdə saxlayın və",
        "zəngə cavab verməyi unutmayın!",
        "Elektron poçt ünvanınızı qeyd edin və biz məhsulumuzun istifadəsi üzrə ətraflı təlimat göndərəcəyik!",
        "Elektron poçtunuzu buraxaraq növbəti sifarişlərdə endirim əldə edəcəksiniz!",
        "Aksiya detallarını məktubda tapacaqsınız.",
        "Zəhmət olmasa, keçərli elektron poçt ünvanı daxil edin.",
        "Təşəkkürlər! Təlimatlar yaxın vaxtda elektron poçtunuza göndəriləcək."
    ],
    'zh' => [
        "谢谢!", 
        "您的订单已被我们的团队接收和处理。",
        "注意!",
        "我们的专家将在近期与您联系!",
        "请注意您的电话并",
        "不要错过电话!",
        "请留下您的电子邮件地址，我们将发送详细的使用说明!",
        "留下您的电子邮件后，您将获得下一次订单的折扣!",
        "活动详情将在邮件中。",
        "请输入有效的电子邮件地址。",
        "谢谢! 使用说明将很快发送到您的电子邮件。"
    ],
    'cs' => [
        "Děkujeme!", 
        "Vaše objednávka byla přijata naším týmem.",
        "UPOZORNĚNÍ!",
        "NÁŠ ODBORNÍK VÁM BRZY ZAVOLÁ!",
        "Prosím, sledujte svůj telefon a",
        "nezmeškejte hovor!",
        "Prosím, zanechte svou e-mailovou adresu a my vám zašleme podrobné pokyny k používání našich produktů!",
        "Zanecháním svého e-mailu získáte slevu na další objednávky!",
        "Podrobnosti o akci budou v e-mailu.",
        "Zadejte prosím platnou e-mailovou adresu.",
        "Děkujeme! Pokyny budou brzy zaslány na váš e-mail."
    ],
    'de' => [
        "Danke!", 
        "Ihre Bestellung wurde von unserem Team erhalten und bearbeitet.",
        "ACHTUNG!",
        "UNSER SPEZIALIST WIRD SIE BALD ANRUFEN!",
        "Bitte achten Sie auf Ihr Telefon und",
        "verpassen Sie keinen Anruf!",
        "Bitte hinterlassen Sie Ihre E-Mail-Adresse und wir senden Ihnen eine detaillierte Anleitung zur Nutzung unserer Produkte!",
        "Indem Sie Ihre E-Mail hinterlassen, erhalten Sie einen Rabatt auf zukünftige Bestellungen!",
        "Details zur Aktion finden Sie in der E-Mail.",
        "Bitte geben Sie eine gültige E-Mail-Adresse ein.",
        "Danke! Die Anweisungen werden bald an Ihre E-Mail gesendet."
    ],
    'en' => [
        "Thank you!", 
        "Your order has been received and processed by our team.",
        "ATTENTION!",
        "OUR SPECIALIST WILL CALL YOU SOON!",
        "Please keep an eye on your phone and",
        "do not miss the call!",
        "Please leave your email address and we will send you detailed instructions on how to use our product!",
        "By leaving your email, you will receive a discount on future orders!",
        "The details of the promotion will be in the email.",
        "Please enter a valid email address.",
        "Thank you! Instructions will be sent to your email shortly."
    ],
    'es' => [
        "¡Gracias!", 
        "Su pedido ha sido recibido y procesado por nuestro equipo.",
        "¡ATENCIÓN!",
        "¡NUESTRO ESPECIALISTA LE LLAMARÁ PRONTO!",
        "Por favor, esté atento a su teléfono y",
        "¡no se pierda la llamada!",
        "Por favor, deje su dirección de correo electrónico y le enviaremos instrucciones detalladas sobre cómo usar nuestro producto.",
        "Al dejar su correo electrónico, recibirá un descuento en futuros pedidos.",
        "Los detalles de la promoción estarán en el correo electrónico.",
        "Por favor, introduzca una dirección de correo electrónico válida.",
        "¡Gracias! Las instrucciones serán enviadas a su correo electrónico en breve."
    ],
    'fr' => [
        "Merci!", 
        "Votre commande a été reçue et traitée par notre équipe.",
        "ATTENTION!",
        "NOTRE SPÉCIALISTE VOUS APPELLERA BIENTÔT!",
        "Veuillez surveiller votre téléphone et",
        "ne manquez pas l'appel!",
        "Veuillez laisser votre adresse e-mail et nous vous enverrons des instructions détaillées sur l'utilisation de notre produit!",
        "En laissant votre e-mail, vous recevrez une réduction sur les commandes futures!",
        "Les détails de la promotion seront dans l'e-mail.",
        "Veuillez entrer une adresse e-mail valide.",
        "Merci! Les instructions seront envoyées à votre e-mail sous peu."
    ],
    'he' => [
        "תודה!", 
        "ההזמנה שלך התקבלה ועובדה על ידי הצוות שלנו.",
        "תשומת לב!",
        "המומחה שלנו יתקשר אליך בקרוב!",
        "אנא עקוב אחר הטלפון שלך ו",
        "אל תחמיץ את השיחה!",
        "אנא השאר את כתובת הדוא\"ל שלך ואנו נשלח לך הוראות מפורטות לשימוש במוצר שלנו!",
        "על ידי השארת הדוא\"ל שלך, תקבל הנחה על הזמנות עתידיות!",
        "פרטי המבצע יהיו באימייל.",
        "אנא הזן כתובת דוא\"ל חוקית.",
        "תודה! ההוראות יישלחו לדוא\"ל שלך בקרוב."
    ],
    'hu' => [
        "Köszönjük!", 
        "Rendelését csapatunk megkapta és feldolgozta.",
        "FIGYELEM!",
        "SZAKÉRTŐNK HAMAROSAN FELHÍVJA ÖNT!",
        "Kérjük, figyelje a telefonját és",
        "ne hagyja ki a hívást!",
        "Kérjük, hagyja meg e-mail címét, és részletes utasításokat küldünk a termékünk használatáról!",
        "E-mail címének megadásával kedvezményt kap a jövőbeni rendeléseihez!",
        "Az akció részleteit az e-mailben találja.",
        "Kérjük, adjon meg érvényes e-mail címet.",
        "Köszönjük! Az utasításokat hamarosan elküldjük az e-mail címére."
    ],
    'id' => [
        "Terima kasih!", 
        "Pesanan Anda telah diterima dan diproses oleh tim kami.",
        "PERHATIAN!",
        "SPESIALIS KAMI AKAN SEGERA MENGHUBUNGI ANDA!",
        "Harap perhatikan telepon Anda dan",
        "jangan lewatkan panggilan!",
        "Harap tinggalkan alamat email Anda dan kami akan mengirimkan instruksi rinci tentang cara menggunakan produk kami!",
        "Dengan meninggalkan email Anda, Anda akan mendapatkan diskon untuk pesanan selanjutnya!",
        "Detail promosi akan ada di email.",
        "Harap masukkan alamat email yang valid.",
        "Terima kasih! Instruksi akan segera dikirim ke email Anda."
    ],
    'it' => [
        "Grazie!", 
        "Il tuo ordine è stato ricevuto e processato dal nostro team.",
        "ATTENZIONE!",
        "IL NOSTRO SPECIALISTA TI CHIAMERÀ PRESTO!",
        "Si prega di tenere d'occhio il telefono e",
        "non perdere la chiamata!",
        "Per favore, lascia il tuo indirizzo email e ti invieremo istruzioni dettagliate su come usare il nostro prodotto!",
        "Lasciando la tua email, riceverai uno sconto sui prossimi ordini!",
        "I dettagli della promozione saranno nell'email.",
        "Si prega di inserire un indirizzo email valido.",
        "Grazie! Le istruzioni saranno inviate al tuo indirizzo email a breve."
    ],
    'ja' => [
        "ありがとうございます!", 
        "ご注文は当チームにより受け付けられ、処理されました。",
        "注意!",
        "専門家がすぐにお電話いたします！",
        "お電話にご注意ください、そして",
        "電話を見逃さないでください！",
        "メールアドレスを入力してください。当社製品の使用方法に関する詳細な指示をお送りします！",
        "メールアドレスを残すと、次回の注文で割引を受け取ります！",
        "プロモーションの詳細はメールに記載されています。",
        "有効なメールアドレスを入力してください。",
        "ありがとうございます！指示はすぐにあなたのメールに送信されます。"
    ],
    'kk' => [
        "Рақмет!", 
        "Тапсырысыңыз біздің командамен қабылданды және өңделді.",
        "НАЗАР АУДАРЫҢЫЗ!",
        "БІЗДІҢ МАМАН ЖАҚЫНДА СІЗГЕ ҚОҢЫРАУ ШАЛАДЫ!",
        "Телефоныңызды бақылап отырыңыз және",
        "қоңырауды өткізіп алмаңыз!",
        "Электрондық пошта мекенжайыңызды қалдырыңыз, біз өнімді пайдалану бойынша егжей-тегжейлі нұсқаулық жібереміз!",
        "Электрондық поштаңызды қалдырып, келесі тапсырыстарға жеңілдік аласыз!",
        "Акция туралы толық ақпарат хатта болады.",
        "Жарамды электрондық пошта мекенжайын енгізіңіз.",
        "Рақмет! Нұсқаулар жақында сіздің электрондық поштаңызға жіберіледі."
    ],
    'my' => [
        "ကျေးဇူးတင်ပါတယ်!", 
        "သင့်မှာယူမှုကို ကျွန်ုပ်တို့၏အဖွဲ့မှ လက်ခံပြီး ကုသမည်။",
        "သတိပြုပါ!",
        "ကျွန်ုပ်တို့၏ကျွမ်းကျင်သူမှ မကြာမီ သင့်ကို ဆက်သွယ်ပါမည်။",
        "ကျေးဇူးပြု၍ ဖုန်းကို ထိန်းသိမ်းပါနှင့်",
        "ခေါ်ဆိုမှုကို မဖြစ်မနေပါ။",
        "ကျေးဇူးပြု၍ သင့်၏အီးမေးလ်လိပ်စာကိုထားခဲ့ပါ။ကျွန်ုပ်တို့၏ထုတ်ကုန်ကိုဘယ်လိုအသုံးပြုရမည်ဆိုသော အသေးစိတ်ညွှန်ကြားချက်များကို ပို့ပါမည်။",
        "အီးမေးလ်လိပ်စာကိုထားခဲ့ခြင်းဖြင့် လာမည့်မှာယူမှုများအတွက် လျှော့စျေးရပါမည်။",
        "လှုပ်ရှားမှုအသေးစိတ်ကို အီးမေးလ်တွင်ရရှိပါမည်။",
        "တရားဝင်အီးမေးလ်လိပ်စာကိုထည့်ပါ။",
        "ကျေးဇူးတင်ပါတယ်! ညွှန်ကြားချက်များကို မကြာမီသင့်အီးမေးလ်သို့ ပို့ပါမည်။"
    ],
    'nl' => [
        "Dank je!", 
        "Je bestelling is ontvangen en verwerkt door ons team.",
        "LET OP!",
        "ONZE SPECIALIST BELT U BINNENKORT!",
        "Houd alstublieft uw telefoon in de gaten en",
        "mis de oproep niet!",
        "Laat uw e-mailadres achter en wij sturen u gedetailleerde instructies over hoe u ons product kunt gebruiken!",
        "Door uw e-mailadres achter te laten, ontvangt u korting op toekomstige bestellingen!",
        "De details van de actie staan in de e-mail.",
        "Voer een geldig e-mailadres in.",
        "Dank je! De instructies worden binnenkort naar uw e-mail verzonden."
    ],
    'pl' => [
        "Dziękuję!", 
        "Twoje zamówienie zostało przyjęte i przetworzone przez nasz zespół.",
        "UWAGA!",
        "NASZ SPECJALISTA WKRÓTCE DO CIEBIE ZADZWONI!",
        "Proszę obserwować swój telefon i",
        "nie przegap połączenia!",
        "Proszę podać swój adres e-mail, a my wyślemy szczegółowe instrukcje dotyczące korzystania z naszego produktu!",
        "Podając swój e-mail, otrzymasz rabat na przyszłe zamówienia!",
        "Szczegóły promocji będą w e-mailu.",
        "Proszę podać prawidłowy adres e-mail.",
        "Dziękuję! Instrukcje zostaną wkrótce wysłane na Twój e-mail."
    ],
    'pt' => [
        "Obrigado!", 
        "Seu pedido foi recebido e processado pela nossa equipe.",
        "ATENÇÃO!",
        "NOSSO ESPECIALISTA LIGARÁ PARA VOCÊ EM BREVE!",
        "Por favor, fique de olho no seu telefone e",
        "não perca a ligação!",
        "Por favor, deixe seu endereço de e-mail e nós enviaremos instruções detalhadas sobre como usar nosso produto!",
        "Deixando seu e-mail, você receberá um desconto em futuros pedidos!",
        "Os detalhes da promoção estarão no e-mail.",
        "Por favor, insira um endereço de e-mail válido.",
        "Obrigado! As instruções serão enviadas para o seu e-mail em breve."
    ],
    'ro' => [
        "Mulțumim!", 
        "Comanda dvs. a fost primită și procesată de echipa noastră.",
        "ATENȚIE!",
        "SPECIALISTUL NOSTRU VĂ VA SUNA ÎN CURÂND!",
        "Vă rugăm să fiți atent la telefon și",
        "nu ratați apelul!",
        "Vă rugăm să lăsați adresa dvs. de e-mail și vă vom trimite instrucțiuni detaliate despre cum să utilizați produsul nostru!",
        "Lăsând adresa de e-mail, veți primi o reducere la comenzile viitoare!",
        "Detaliile promoției vor fi în e-mail.",
        "Vă rugăm să introduceți o adresă de e-mail validă.",
        "Mulțumim! Instrucțiunile vor fi trimise în curând la adresa dvs. de e-mail."
    ],
    'sv' => [
        "Tack!", 
        "Din beställning har tagits emot och bearbetats av vårt team.",
        "UPPMÄRKSAMHET!",
        "VÅR SPECIALIST KOMMER ATT RINGA DIG SNART!",
        "Var snäll och håll koll på din telefon och",
        "missa inte samtalet!",
        "Vänligen lämna din e-postadress och vi skickar detaljerade instruktioner om hur du använder vår produkt!",
        "Genom att lämna din e-post får du rabatt på framtida beställningar!",
        "Detaljer om kampanjen kommer att finnas i e-postmeddelandet.",
        "Vänligen ange en giltig e-postadress.",
        "Tack! Instruktionerna kommer att skickas till din e-post inom kort."
    ],
    'sk' => [
        "Ďakujeme!", 
        "Vaša objednávka bola prijatá a spracovaná naším tímom.",
        "POZOR!",
        "NÁŠ ŠPECIALISTA VÁM ČOSKORO ZAVOLÁ!",
        "Prosím, sledujte svoj telefón a",
        "nepremeškajte hovor!",
        "Prosím, zanechajte svoju e-mailovú adresu a my vám pošleme podrobné pokyny na používanie nášho produktu!",
        "Zanechaním svojho e-mailu získate zľavu na ďalšie objednávky!",
        "Podrobnosti o akcii budú v e-maile.",
        "Zadajte prosím platnú e-mailovú adresu.",
        "Ďakujeme! Pokyny budú čoskoro odoslané na váš e-mail."
    ],
    'tr' => [
        "Teşekkürler!", 
        "Siparişiniz ekibimiz tarafından alındı ​​ve işlendi.",
        "DİKKAT!",
        "UZMANIMIZ YAKINDA SIZINLE ILETIŞIME GEÇECEK!",
        "Lütfen telefonunuza dikkat edin ve",
        "çağrıyı kaçırmayın!",
        "Lütfen e-posta adresinizi bırakın ve size ürünümüzün nasıl kullanılacağına dair ayrıntılı talimatlar göndereceğiz!",
        "E-postanızı bırakarak, gelecekteki siparişlerde indirim alacaksınız!",
        "Kampanyanın detayları e-postada olacak.",
        "Lütfen geçerli bir e-posta adresi girin.",
        "Teşekkürler! Talimatlar yakında e-postanıza gönderilecektir."
    ],
    'uk' => [
        "Дякуємо!", 
        "Ваше замовлення було прийнято та оброблено нашою командою.",
        "УВАГА!",
        "НАШ СПЕЦІАЛІСТ НЕЗАБАРОМ ЗАТЕЛЕФОНУЄ ВАМ!",
        "Будь ласка, слідкуйте за своїм телефоном і",
        "не пропустіть дзвінок!",
        "Будь ласка, залиште свою електронну адресу, і ми надішлемо вам детальні інструкції щодо використання нашої продукції!",
        "Залишивши свою електронну пошту, ви отримаєте знижку на наступні замовлення!",
        "Деталі акції будуть в листі.",
        "Будь ласка, введіть дійсну електронну адресу.",
        "Дякуємо! Інструкції будуть надіслані на вашу електронну пошту найближчим часом."
    ],
    'vi' => [
        "Cảm ơn bạn!", 
        "Đơn hàng của bạn đã được đội ngũ của chúng tôi nhận và xử lý.",
        "CHÚ Ý!",
        "CHUYÊN GIA CỦA CHÚNG TÔI SẼ SỚM GỌI CHO BẠN!",
        "Vui lòng chú ý điện thoại của bạn và",
        "không bỏ lỡ cuộc gọi!",
        "Vui lòng để lại địa chỉ email của bạn và chúng tôi sẽ gửi hướng dẫn chi tiết về cách sử dụng sản phẩm của chúng tôi!",
        "Bằng cách để lại email của bạn, bạn sẽ nhận được giảm giá cho các đơn hàng tiếp theo!",
        "Chi tiết của chương trình khuyến mãi sẽ có trong email.",
        "Vui lòng nhập địa chỉ email hợp lệ.",
        "Cảm ơn bạn! Hướng dẫn sẽ sớm được gửi đến email của bạn."
    ],
    'lv' => [
       "Paldies!", 
       "Jūsu pasūtījums ir pieņemts un apstrādāts mūsu komandas.",
       "UZMANĪBU!",
       "MŪSU SPECIĀLISTS DRĪZ AR JUMS SAZINĀSIES!",
       "Lūdzu, sekojiet līdzi savam tālrunim un",
       "nepalaidiet garām zvanu!",
       "Lūdzu, atstājiet savu e-pasta adresi, un mēs jums nosūtīsim detalizētas instrukcijas par mūsu produkta lietošanu!",
       "Atstājot savu e-pasta adresi, jūs saņemsiet atlaidi nākamajiem pasūtījumiem!",
       "Informācija par akciju būs e-pastā.",
       "Lūdzu, ievadiet derīgu e-pasta adresi.",
       "Paldies! Instrukcijas drīzumā tiks nosūtītas uz jūsu e-pastu."
    ],
     'lt' => [
       "Ačiū!", 
       "Jūsų užsakymas buvo priimtas ir apdorotas mūsų komandos.",
       "DĖMESIO!",
       "MŪSŲ SPECIALISTAS NETRUKUS SU JUMIS SUSISIEKS!",
       "Prašome stebėti savo telefoną ir",
       "nepraleiskite skambučio!",
        "Prašome palikti savo el. pašto adresą ir mes atsiųsime jums išsamias instrukcijas, kaip naudoti mūsų produktą!",
       "Palikdami savo el. pašto adresą, gausite nuolaidą būsimuose užsakymuose!",
       "Akcijos informacija bus el. laiške.",
       "Prašome įvesti galiojantį el. pašto adresą.",
       "Ačiū! Instrukcijos netrukus bus išsiųstos į jūsų el. paštą."
    ],
     'cz' => [
       "Děkujeme!", 
       "Vaše objednávka byla přijata a zpracována naším týmem.",
       "POZOR!",
       "NÁŠ ODBORNÍK VÁM BRZY ZAVOLÁ!",
       "Prosím, sledujte svůj telefon a",
       "nezmeškejte hovor!",
       "Prosím, zanechte svou e-mailovou adresu a my vám zašleme podrobné pokyny k používání našich produktů!",
       "Zanecháním svého e-mailu získáte slevu na další objednávky!",
       "Podrobnosti o akci budou v e-mailu.",
       "Zadejte prosím platnou e-mailovou adresu.",
       "Děkujeme! Pokyny budou brzy zaslány na váš e-mail."
    ],
     'el' => [
      "Ευχαριστώ!", 
       "Η παραγγελία σας έχει ληφθεί και επεξεργαστεί από την ομάδα μας.",
       "ΠΡΟΣΟΧΗ!",
        "Ο ΕΙΔΙΚΌΣ ΜΑΣ ΘΑ ΣΑΣ ΚΑΛΈΣΕΙ ΣΎΝΤΟΜΑ!",
       "Παρακαλούμε να παρακολουθείτε το τηλέφωνό σας και",
       "μην χάσετε την κλήση!",
       "Παρακαλούμε αφήστε τη διεύθυνση email σας και θα σας στείλουμε λεπτομερείς οδηγίες για τη χρήση του προϊόντος μας!",
       "Αφήνοντας το email σας, θα λάβετε έκπτωση στις μελλοντικές παραγγελίες!",
       "Οι λεπτομέρειες της προώθησης θα είναι στο email.",
       "Παρακαλούμε εισάγετε μια έγκυρη διεύθυνση email.",
       "Ευχαριστώ! Οι οδηγίες θα σταλούν σύντομα στο email σας."
    ],
     'ro' => [
       "Mulțumim!", 
        "Comanda dvs. a fost primită și procesată de echipa noastră.",
        "ATENȚIE!",
        "SPECIALISTUL NOSTRU VĂ VA SUNA ÎN CURÂND!",
        "Vă rugăm să fiți atent la telefon și",
        "nu ratați apelul!",
        "Vă rugăm să lăsați adresa dvs. de e-mail și vă vom trimite instrucțiuni detaliate despre cum să utilizați produsul nostru!",
        "Lăsând adresa de e-mail, veți primi o reducere la comenzile viitoare!",
        "Detaliile promoției vor fi în e-mail.",
       "Vă rugăm să introduceți o adresă de e-mail validă.",
      "Mulțumim! Instrucțiunile vor fi trimise în curând la adresa dvs. de e-mail."
    ],
     'sr' => [
       "Hvala!", 
       "Vaša narudžbina je primljena i obrađena od strane našeg tima.",
       "PAŽNJA!",
       "NAŠ STRUČNJAK ĆE VAS USKORO POZVATI!",
       "Molimo vas da pazite na svoj telefon i",
       "ne propustite poziv!",
       "Molimo vas da ostavite svoju imejl adresu i mi ćemo vam poslati detaljna uputstva o korišćenju našeg proizvoda!",
        "Ostavljanjem svoje imejl adrese dobićete popust na buduće narudžbine!",
       "Detalji akcije će biti u imejlu.",
       "Molimo vas da unesete važeću imejl adresu.",
       "Hvala! Uputstva će uskoro biti poslata na vašu imejl adresu."
    ],
      'bn' => [
        "ধন্যবাদ!", 
       "আপনার অর্ডারটি আমাদের টিম দ্বারা গৃহীত এবং প্রক্রিয়া করা হয়েছে।",
       "সতর্কতা!",
       "আমাদের বিশেষজ্ঞ আপনাকে শীঘ্রই কল করবেন!",
       "অনুগ্রহ করে আপনার ফোনের দিকে নজর রাখুন এবং",
       "কল মিস করবেন না!",
       "অনুগ্রহ করে আপনার ইমেইল ঠিকানা দিন এবং আমরা আপনাকে আমাদের পণ্য ব্যবহার করার বিস্তারিত নির্দেশাবলী পাঠাবো!",
       "আপনার ইমেইল ঠিকানা দিয়ে, আপনি ভবিষ্যতের অর্ডারে ছাড় পাবেন!",
       "অফারের বিস্তারিত ইমেইলে থাকবে।",
       "অনুগ্রহ করে একটি বৈধ ইমেইল ঠিকানা দিন।",
       "ধন্যবাদ! নির্দেশাবলী শীঘ্রই আপনার ইমেইলে পাঠানো হবে।"
    ],
      'ko' => [
       "감사합니다!", 
       "귀하의 주문이 접수되어 처리되었습니다.",
       "주의!",
       "저희 전문가가 곧 연락드릴 것입니다!",
       "전화기를 확인해주시고",
       "전화를 놓치지 마세요!",
       "이메일 주소를 남겨주시면 저희 제품 사용 방법에 대한 자세한 지침을 보내드리겠습니다!",
       "이메일을 남기시면 다음 주문에서 할인을 받으실 수 있습니다!",
       "프로모션 세부 사항은 이메일에 있습니다.",
       "유효한 이메일 주소를 입력해주세요.",
       "감사합니다! 지침이 곧 이메일로 발송될 것입니다."
   ],
     'th' => [
        "ขอบคุณ!", 
        "คำสั่งซื้อของคุณได้รับการดำเนินการโดยทีมของเราแล้ว",
       "คำเตือน!",
        "ผู้เชี่ยวชาญของเราจะโทรหาคุณในไม่ช้า!",
       "กรุณาระวังโทรศัพท์ของคุณและ",
       "อย่าพลาดการโทร!",
       "กรุณาใส่อีเมลของคุณ และเราจะส่งคำแนะนำวิธีใช้ผลิตภัณฑ์ของเราให้คุณ!",
       "การใส่อีเมลของคุณ คุณจะได้รับส่วนลดสำหรับการสั่งซื้อครั้งต่อไป!",
       "รายละเอียดของโปรโมชั่นจะอยู่ในอีเมล",
       "กรุณาใส่อีเมลที่ถูกต้อง",
      "ขอบคุณ! คำแนะนำจะถูกส่งไปยังอีเมลของคุณในไม่ช้า"
   ],
     'tl' => [
       "Salamat!", 
       "Natanggap at naproseso na ng aming team ang iyong order.",
       "PAG-INGAT!",
       "TATAWAGAN KA NG AMING ESPESYALISTA SA LALONG MADALING PANAHON!",
       "Mangyaring bantayan ang iyong telepono at",
       "huwag palampasin ang tawag!",
       "Mangyaring ilagay ang iyong email address at magpapadala kami ng detalyadong mga tagubilin kung paano gamitin ang aming produkto!",
       "Sa pamamagitan ng pag-iwan ng iyong email, makakatanggap ka ng diskwento sa mga susunod na order!",
       "Ang mga detalye ng promosyon ay nasa email.",
       "Mangyaring maglagay ng wastong email address.",
       "Salamat! Ang mga tagubilin ay ipapadala sa iyong email sa lalong madaling panahon."
    ]
];



// Set the messages based on the determined language
  if (array_key_exists($language, $messages)) {
    $translation = $messages[$language];
  } else {
    // Default to English if the language is not in the messages array
    $translation = $messages['en'];
  }


?>
<!DOCTYPE html>
<html lang="<?php echo $language; ?>" dir="<?php if($language == "he" || $language == "ar"){echo "rtl";} ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAADx7+cA8e7pAO/t6ADz7ekA9O3uA/Hu6WPg3tjB29nW8+Pf2tny7uiN8PDtGfTx7AD37uoA7+zrAPPs6wD07OwA8e/nAPHu6QDv7egA7ejmh8TBwP/g2t3/y8fE/7i+sv++vbf/yMPD/8TCvf/r7Obd9+/qDu/s6wDz7OsA9OzsAPHv5wDy7ukA1NLO2fXx8/96n2X/H30c/yKeLv8trkP/JbM//ySVMf9cjFL/zsfJ/9jV0v/w7OwZ8+zrAPTs7ADx7+cA5eHda/z7+P8tZxL/KYkm/yeYK/8tpTn/LK1G/y+zS/8yt03/MLZO/ymPK//Fv77/2djP//Ps6wf07OwA8OvnF9jU1/I0ZRT/M3ki/yWDH/+BtIP/S41T/yujP/8yskf/L7BO/zO0Sv8ztEr/K4Yq/9DHy//y7ujB8+3oANrX03O9x7P/OGkb/yhyDf+ivKX/ys3N/9PT0/9gmGf/J586/y+tQv8trEf/MKxB/yWlOv95kW//ysbG//Hv5Q/Qyc7BhZlt/y9lEP+xw6z/1NPV/8fPzv/Jysn/zcvR/2Oca/8mnDL/LaI8/y6iN/8loDH/KXsb/8K9yP/y7+Z+x8XI52l/Rv/Dz7n/5+jj/+rs7f9zomn/5Ovq/8LKyv/O0tD/bJlw/yOPKv8mlyr/J44q/yF+F//W0dL/6OLdyb66vPFkejv/gpVp//38//9nilT/NXce/yRyE//m6OT/y8/W/9TZ1v96oHf/MYMs/ymGI/8ndBT/1tbV/+Xg397FwcTXanpB/1l2M/9YcTj/XIVH/2WHS/9fiVT/UoxB/+vx6v/Z1tf/2trh/5Stjv9VjUn/J2QQ/+bc4P/l4t2qzMbKp4CNZv9dciz/XHM2/198PP9egUT/X4VI/12ITf9Yf0H/5u/n/9Xa2f/d2tr/iKKB/16AQv/NzdH/8O7iSdbTzkWwr6b/WGsk/1ttLP9cdTP/XXg5/158Pv9gfkT/YIVE/1h8Pv/k6+X/3OHd/1p+Pv+8yK7/ysXJ+vDt5QDu7OMAysfJvV9tNv9aayn/XG4r/15wLv9dcjP/XXc0/111O/9eejr/Wnc1/1h0NP9jekH/4eDg//Tv6U7w6uQA7uvjANrW0RfMy8z/XW8z/1tsJv9cbSv/W20s/15vLv9fcDH/XHEw/1pyLf9idzz/+Pj2/9/b1rjv6+IA8OrjAO7r4wDZ1tEAz8zGGsrHxsOvsqb/f4tj/2p6Pv9jczj/antA/4uUbv/FyLv/0tDQ7unm31jv6+MA7+viAPDq4wDu6+MA2dbRAM7NxgDl4N0A1dLOTsnExbHHxMXgvru8+cfExuzLycjG09HKdezn5BTx7uYA7+vjAO/r4gDw6uMA/D8AAOAPAADABwAAwAMAAIABAACAAQAAAAEAAAAAAAAAAAAAAAAAAAABAACAAQAAgAMAAMADAADgDwAA+D8AAA==" rel="icon" type="image/x-icon">
    <title>Thank You</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .thank-you {
            text-align: center;
            margin-bottom: 20px;
        }
        .order-details {
            text-align: right;
            margin-bottom: 20px;
        }
        .maximize-purchase, .email-instructions {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .email-instructions {
            text-align: center;
        }
        .email-instructions form {
            display: inline-block;
            margin-top: 10px;
        }
        .email-instructions input[type="email"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 250px;
        }
        .email-instructions button {
            padding: 10px 20px;
            background-color: #f0c040;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .customer-service {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        .customer-service img {
            border-radius: 50%;
            margin-right: 20px;
            max-width: 25%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="thank-you">
            <h1><?php echo $translation[0]; ?></h1>
            <b><?php echo $translation[1]; ?></b>
        </div>
        <div class="maximize-purchase">
            <h2 style="text-align: center;"><b style="color:red"><?php echo $translation[2]; ?></b><br><br><?php echo $translation[3]; ?></h2>
            <div class="customer-service">
                <img src="https://i.ibb.co/Z6w6vW2/technical-support-customer-service-company-call-center-agent-removebg-preview.png" alt="Customer Service Representative">
                <h3><?php echo $translation[4]; ?> <b style="color:red"><?php echo $translation[5]; ?></b></h3>
            </div>
        </div>
        <div class="email-instructions">
            <h3><?php echo $translation[6]; ?></h3>
            <form id="emailForm">
                <input type="email" id="email" placeholder="e-mail">
                <button type="button" onclick="checkEmail()"><?php if($language == "he" || $language == "ar"){echo "&larr;";}else{echo "&rarr;";} ?></button>
            </form>
            <br><br><i><b><?php echo $translation[7]; ?></b></i>
            <br><i><b><?php echo $translation[8]; ?></b></i>  
        </div>
    </div>

    <script>
        function checkEmail() {
            const email = document.getElementById('email').value;
            if (email === '' || !email.match(/^[^ ]+@[^ ]+\.[a-z]{2,3}$/)) {
                alert('<?php echo $translation[9]; ?>');
            } else {
                alert('<?php echo $translation[10]; ?>');
            }
        }
    </script>
    <!-- Facebook Pixel Code-->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');

      fbq("init", "<?php echo $_GET['p']; ?>");
      fbq("track", "Lead");

    </script>
    <noscript>
      <img height="1" width="1" style="display:none" 
      src="https://www.facebook.com/tr?id=<?php echo $_GET['p']; ?>&ev=Lead&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
</body>
</html>
