<?php

namespace App\Common\Service;

use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploaderHelper
{

    public const CATEGORY_IMAGE_PATH = '/category_images';
    public const LOGO_IMAGE_PATH = '/logo_images';
    public const PRODUCT_THUMBNAIL_PATH = '/product_images';

    public function __construct(private string $uploadsPath) {}

    /**
     * Generates a unique filename for the uploaded file.
     *
     * @param string $originalFilename The original name of the file.
     * @return string A unique filename.
     */
    public function uploadCategoryImage(UploadedFile $file): string
    {
        $destinationPath = $this->uploadsPath . '/category_images';
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid('') . '.' . $file->guessExtension();

        $file->move($destinationPath, $newFilename);

        return $newFilename;
    }

    public function uploadLogoImage(UploadedFile $file): string
    {
        $destinationPath = $this->uploadsPath . self::LOGO_IMAGE_PATH;
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid('') . '.' . $file->guessExtension();

        $file->move($destinationPath, $newFilename);

        return $newFilename;
    }

    public function uploadProductThumbnail(UploadedFile $file): string
    {
        $destinationPath = $this->uploadsPath . self::PRODUCT_THUMBNAIL_PATH;
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid('') . '.' . $file->guessExtension();

        $file->move($destinationPath, $newFilename);

        return $newFilename;
    }
}
