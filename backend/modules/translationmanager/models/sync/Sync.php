<?php

namespace backend\modules\translationmanager\models\sync;

use Yii;

class Sync
{

    //<editor-fold desc="Export" defaultstate="collapsed">

    /**
     * Local bazadagi yangi tarjimalarni hostingdagi bazaga export qilish
     * @return bool
     */
    public static function export()
    {

        $session = Yii::$app->session;

        MessageCategoryLocal::updateExportedTime();
        $count = 0;
        $newLocalSourceMessages = SourceMessageLocal::newSourceMessagesOnLocal();

        if (empty($newLocalSourceMessages)){
            $session->addFlash('warning', 'No new translations found on local DB to export');
            return false;
        }

        foreach ($newLocalSourceMessages as $localSourceMessage) {

            $hostSourceMessage = SourceMessageHost::findOne([
                'message' => $localSourceMessage->message,
            ]);

            if ($hostSourceMessage == null) {
                $count ++ ;
                static::exportNewLocalSourceMessageToHosting($localSourceMessage);
            }
        }

        if ($count == 0){
            Yii::$app->session->addFlash('warning', "No new translations found on local DB to export" );
        }else{
            Yii::$app->session->addFlash('success', "New {$count} translations have been exported" );
        }

        return true;

    }

    /**
     * @param $localNewSourceMessage SourceMessageLocal local bazada bor, lekin hostingdagi bazada bo'lmagan tarjima
     * @return bool
     */
    public static function exportNewLocalSourceMessageToHosting($localNewSourceMessage)
    {
        $hostSourceMessage = new SourceMessageHost([
            'message' => $localNewSourceMessage->message,
        ]);
        $hostSourceMessage->category = 'app';
        $hostSourceMessage->created_at = $localNewSourceMessage->created_at;
        $hostSourceMessage->updated_at = $localNewSourceMessage->updated_at;
        if ($hostSourceMessage->save()) {

            $messages = $localNewSourceMessage->messages;
            foreach ($messages as $message) {

                $hostMessage = new  MessageHost();
                $hostMessage->id = $hostSourceMessage->id;
                $hostMessage->language = $message->language;
                $hostMessage->translation = $message->translation;

                if (!$hostMessage->save()) {
                    dump('Local bazadagi yangi Messageni hostingga saqlashda Xatolik yuz berdi!');
                    dd($hostMessage->errors);
                }

            }

            return true;
        } else {

            dump('Local bazadagi yangi SourceMessageni hostingga saqlashda Xatolik yuz berdi!');
            dd($hostSourceMessage->errors);

        }
    }


    //</editor-fold>

   //<editor-fold desc="Import" defaultstate="collapsed">

    public static function import()
    {

        $session = Yii::$app->session;
        $newHostSourceMessages = SourceMessageHost::newSourceMessagesOnHost();
        MessageCategoryLocal::updateImportedTime();
        $count = 0;

        if (empty($newHostSourceMessages)){
            $session->addFlash('warning', 'No new translations found on hosting DB to import');
            return false;
        }

        foreach ($newHostSourceMessages as $hostSourceMessage) {

            $localSourceMessage = SourceMessageLocal::findOne([
                'message' => $hostSourceMessage->message,
            ]);

            if ($localSourceMessage == null) {
                $count ++ ;
                static::importFromHost($hostSourceMessage);
            }

        }
        if ($count == 0){
            Yii::$app->session->addFlash('warning', "No new translations found on host DB to import" );
        }else{

            Yii::$app->session->addFlash('success', "New {$count} translations have been imported" );
        }
        return true;

    }

    /**
     * @param $hostNewSourceMessage SourceMessageHost hostingdagi bazada bor, lekin local bazada bo'lmagan tarjima
     * @return bool
     */
    public static function importFromHost($hostNewSourceMessage)
    {
        $localSourceMessage = new SourceMessageLocal([
            'message' => $hostNewSourceMessage->message,
        ]);
        $localSourceMessage->category = 'app';
        $localSourceMessage->created_at = $hostNewSourceMessage->created_at;
        $localSourceMessage->updated_at = $hostNewSourceMessage->updated_at;
        if ($localSourceMessage->save()) {

            $messages = $hostNewSourceMessage->messages;
            foreach ($messages as $message) {

                $hostMessage = new  MessageLocal();
                $hostMessage->id = $localSourceMessage->id;
                $hostMessage->language = $message->language;
                $hostMessage->translation = $message->translation;

                if (!$hostMessage->save()) {
                    dump('Local bazadagi yangi Messageni hostingga saqlashda Xatolik yuz berdi!');
                    dd($hostMessage->errors);
                }

            }

            return true;
        } else {

            dump('Hostdagi yangi SourceMessageni localga import qilib saqlashda Xatolik yuz berdi!');
            dd($localSourceMessage->errors);

        }
    }


    //</editor-fold>

    public static function latestLocalSourceMessageTime()
    {
        return SourceMessageLocal::find()->orderBy(['created_at' => SORT_DESC])->one()->created_at;
    }

    public static function latestHostSourceMessageTime()
    {
        return SourceMessageHost::find()->orderBy(['created_at' => SORT_DESC])->one()->created_at;
    }


}