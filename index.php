<?php
/** 
 *  Author  : Syamsul Anwar
 *  Website : www.anwar.my.id
 *
 *  Simple LINEBot Messaging API PHP 
 *
 *  Thanks to :
 *  https://medantechno.com
 *
 *  Based on line-bot-sdk-php-master (LINEBotTiny)
 */

# Channel Accsess Token & Channel Secret
$channelAccessToken = '<your channel access token>';
$channelSecret = '<your channel secret>';

/* Aktifkan fungsi ini jika anda menggunakan database dan telah mengimpor database.sql
# Menghubungkan ke database
$koneksi    = new mysqli('localhost', 'user', 'password', 'database_name');
*/

# Memanggil class LINEBotTiny
require_once('./function.php');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);

# Set Variable
$userId     = $client->parseEvents()[0]['source']['userId'];

if (isset($client->parseEvents()[0]['source']['groupId'])) {
    $groupId     = $client->parseEvents()[0]['source']['groupId'];
}

$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp  = $client->parseEvents()[0]['timestamp'];
$message    = $client->parseEvents()[0]['message'];
$messageid  = $client->parseEvents()[0]['message']['id'];
$profil     = $client->profil($userId);

# Membaca pesan masuk

# Command (perintah dengan awalan '/')
$tmp    = str_split($message['text']);
if ($tmp[0] == '/') {
    $tmp    = explode(" ", $message['text']);
    $cmds   = $tmp[0];
    unset($tmp[0]);
    $cmdParam   = implode(" ", $tmp);
}

# Jika pesan adalah teks biasa
else {
    $cmds   = strtolower($message['text']);
}


# Jika pesan masuk bertipe teks
if($message['type']=='text')
{

    /* Aktifkan fungsi ini jika anda menggunakan database dan telah mengimport database.sql
    $check  = $koneksi->query("SELECT * FROM listresponse WHERE name = '$cmds' ORDER BY sort ASC");
    if (mysqli_num_rows($check) > 0) {
        $response   = array();
        while($data   = $check->fetch_object()) {
            if ((!isset($groupId) && $data->ongroup == 0) || (isset($groupId) && $data->ongroup == 1) || ($data->ongroup == 2)) {
                if ($data->type == 'text') {
                    array_push($response, 
                        array(
                            'type' => 'text',
                            'text' => $data->response
                        )
                    );
                } elseif ($data->type == 'image') {
                    array_push($response,
                        array(
                            'type' => 'image',
                            'originalContentUrl' => $data->originalContentUrl,
                            'previewImageUrl' => $data->previewImageUrl 
                        )
                    );
                }
            }
        }

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => $response
        );
    } else
    */

    # Perintah '/leave'
    if($cmds=='/leave')
    {
        $client->leaveGroup($groupId);
    } else

    # Perintah '/help'
    if($cmds == "/help")
    {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                        'type' => 'text',
                        'text' => 'Bantuan

Perintah yang dapat digunakan:

/help -> Bantuan
/tampilkan [teks] -> Menampilkan teks
/leave -> Meninggalkan grup'
                )
            )
        );
    } else

    # Perindah '/tampilkan'
    if ($cmds == '/tampilkan') 
    {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $cmdParam
                )
            )
        );
    } else

    # Balasan jika kata tidak dimengerti (hanya untuk chat 1:1)
    if(!isset($groupId))
    {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                        'type' => 'text',                   
                        'text' => 'Maaf '.$profil->displayName.', untuk saat ini saya belum memahami kata "'.$cmds.'"'
                )
            )
        );
    } else

    # Balasan jika kata tidak dimengerti (hanya untuk chat grup)
    if(isset($groupId))
    {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                        'type' => 'text',                   
                        'text' => $profil->displayName.': '.$cmds
                )
            )
        );
    } else


    # Letakan script response di bagian atas komentar ini.
    # End of response section.

    if (true) {
        #no message
    }

    # ---------------------------------------------------------------
    # Debug Section 
    #
    # Berikut adalah beberapa contoh tipe pengiriman message.
    # (Pindahkan ke bagian atas untuk mencoba)
    #
    # Reference :
    # https://developers.line.me/en/docs/messaging-api/reference/#message-objects
    # ---------------------------------------------------------------

    if($cmds == "/debugflex")
    {
        $balas2 = '{
            "replyToken": "'.$replyToken.'",
            "messages": [{  
                  "type": "flex",
                  "altText": "Info!",
                  "contents": {
                    "type": "bubble",
                    "header": {
                        "type": "box",
                        "layout": "vertical",
                        "contents": [
                            {
                                "type": "text",
                                "text": "Babymetal"
                            }
                        ]
                    },

                    "hero": {
                        "type": "image",
                        "url": "https://letscoding.000webhostapp.com/baby-metal1.jpg",
                        "size": "full",
                        "aspectRatio": "2:1"
                    },

                    "body": {
                        "type": "box",
                        "layout": "vertical",
                        "contents": [
                            {
                                "type": "text",
                                "text": "hello"
                            },
                            {
                                "type": "separator",
                                "color": "#000000"
                            }
                        ]
                    },

                    "footer": {
                        "type": "box",
                        "layout": "vertical",
                        "contents": [
                            {
                                "type": "button",
                                "style": "primary",
                                "action": {
                                    "type": "uri",
                                    "label": "Lihat",
                                    "uri": "https://www.youtube.com/watch?v=1ce456Nnkt8"
                                }
                            }
                        ]
                    }
                }
            }]
        }';

    } else

    if($cmds == "/debugtemplate")
    {
        $balas2 = '{
            "replyToken": "'.$replyToken.'",
            "messages": [
                {
                    "type": "sticker",
                    "packageId": "1",
                    "stickerId": "1"
                },
                {
                    "type": "template",
                    "altText": "This is a buttons template",
                    "template": {
                        "type": "buttons",
                        "thumbnailImageUrl": "https://www.stein-agency.com/wp-content/uploads/stein_web_hp_ar_posma2016_1992x1122px_01-1040x1040.jpg",
                        "imageAspectRatio": "rectangle",
                        "imageSize": "cover",
                        "imageBackgroundColor": "#FFFFFF",
                        "title": "Menu",
                        "text": "Please select",
                        "defaultAction": {
                            "type": "uri",
                            "label": "View detail",
                            "uri": "http://example.com/page/123"
                        },
                        "actions": [
                            {
                                "type": "uri",
                                "label": "View detail",
                                "uri": "http://example.com/page/123"
                            }
                        ]
                    }
                }
            ]
        }';
    } else

    if($cmds=='/debuglocation')
    {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                        'type' => 'location',
                        'title' => 'Berikut adalah lokasi yang anda minta.',
                        'address' => 'Jepang',
                        'latitude' => '35.65910807942215',
                        'longitude' => '139.70372892916203' 
                )
            )
        );        
    } else

    if($cmds=='/debugpushmessage')
    {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                        'type' => 'text',
                        'text' => 'Cek pesan masuk anda.

Fitur ini tidak dapat digunakan untuk Paket Gratis.'
                )
            )
        );

        $push = array(
            'to' => $userId,
            'messages' => array(
                array(
                        'type' => 'text',
                        'text' => 'Testing Push Message.

Hallo! Ini adalah pesan yang anda minta.'
                )
            )
        );

        $client->pushMessage($push);
    }
}

# -------------------------------------------------------------------------------------------
# Mengirim Balasan.

# Jika variable yang di set adalah $balas2, maka data tidak akan melalui proses json_encode
# Jika variable yang di set adalah $balas, maka data akan melalui proses json_encode

# Data yang berupa array harus melalui proses json_encode
# Data yang sudah berupa JSON tidak perlu melalui proses json_encode
# -------------------------------------------------------------------------------------------

if (isset($balas2)) {

    # Untuk debug
    $result =  $balas2;
    file_put_contents('./balasan.json',$result);

    # Proses mengirim tanpa json_encode
    $client->replyMessage($balas2, true);



} else

if (isset($balas)) {

    # Untuk debug
    $result =  json_encode($balas);
    file_put_contents('./balasan.json',$result);

    # Proses mengirim pesan dengan encode
    $client->replyMessage($balas);

}