<?php

namespace App\Http\Controllers\Admin\Overrides;


use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\Http\Controllers\FileViewController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\Media as MediaModel;

class ModifiedFileViewController extends FileViewController {

	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function view( Request $request ) {
		$this->validate( $request, [
			'path' => 'required|string'
		] );

		list( $fileId ) = explode( "/", $request->get( 'path' ), 2 );

		if ( $medium = app( MediaModel::class )->find( $fileId ) ) {

			/** @var HasMediaCollectionsTrait $model */
			$model = $medium->model; // PHPStorm sees it as an error - Spatie should fix this using PHPDoc

			if ( $mediaCollection = $model->getMediaCollection( $medium->collection_name ) ) {

				if ( $mediaCollection->getViewPermission() ) {
					$this->authorize( $mediaCollection->getViewPermission(), [ $model ] );
				}

				$storagePath = $request->get( 'path' );
				$fileSystem  = Storage::disk( $mediaCollection->getDisk() );

				if ( ! $fileSystem->has( $storagePath ) ) {
					abort( 404 );
				}

				return Response::make( $fileSystem->get( $storagePath ), 200, [
					'Content-Type'        => $fileSystem->mimeType( $storagePath ),
					'Content-Disposition' => 'inline; filename="' . basename( $request->get( 'path' ) ) . '"'
				] );
			}
		}

		abort( 404 );
	}
}
