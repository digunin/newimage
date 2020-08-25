<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'new-db' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'new-admin' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '3A,To7Y?mTZyQg}AA.d%&4yUge%q{Vn]bO}c4=p6nm?su&):CegTx}8kco`0Fl5;' );
define( 'SECURE_AUTH_KEY',  '] yI mIZ8jm9}Mn=@i4_TeJoGFh|HE5mcVg/T-FF2+qqI+z)d5o~;d98S*`:QyIQ' );
define( 'LOGGED_IN_KEY',    'nCYi)8rt,rK|<|p#-}wA9[d.ff}gR6Kn-%&O 4p%GS7OAj}n9~aE1%F_O>o#9STH' );
define( 'NONCE_KEY',        '=|*Yz`/[q{lqNoMkGw@q >e[j)rR:/xEwO></(^PT8c-p~C:p&}eafRb.%+@-<zo' );
define( 'AUTH_SALT',        't$[?Ozqbe%<cLQ{m{f?Mfo(Koc@Z!<eG{H{52zN>l,-$I11;,FZ$jnRsbR9MsF =' );
define( 'SECURE_AUTH_SALT', '7$VF;sWYvS<K%aqzK}x3u,u}=,Ou;Mp>5h<t|Kv#}0J%R[ODbC[OM9JL3Fd~+?TK' );
define( 'LOGGED_IN_SALT',   'T8#}+5[hFL0P<SJ2k?s_$+kY&<nWmV.?<@pde/$J VEWD^&0%&Wj=(3y-ce7]v-^' );
define( 'NONCE_SALT',       '{rDH(+EE0t(XJW{9={:5A:,Q)+8x{}PS.?<=4#{X7J01}|?T=!-MR!WUC3(HF29(' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
