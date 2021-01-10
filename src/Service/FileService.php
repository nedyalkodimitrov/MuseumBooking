<?php


namespace App\Service;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Filesystem\Filesystem;

class FileService
{

    private $params;
    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function MoveImage(FormInterface $form, bool $museum)
    {
        $filesystem = new Filesystem();

        if($museum){
            $imageDirectory = 'museum_images_directory';
        }else{
            $imageDirectory = 'tourOperator_images_directory';
        }
        if ($form->isSubmitted()) {
            /** @var UploadedFile $file */
            $file = $form->get('image')->getData();
//            var_dump($file);

            $imageNewFileName = $this->generateUniqueFileName() . uniqid() . '.' . $file->getExtension();
//            var_dump($filesystem->exists( $this->params->get('images_directory')));

            try {

                $file->move(
                    $this->params->get($imageDirectory),
                    $imageNewFileName
                );
                return $imageNewFileName;
            } catch (\Exception $e) {
                return $imageNewFileName;
            }
        }
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

}