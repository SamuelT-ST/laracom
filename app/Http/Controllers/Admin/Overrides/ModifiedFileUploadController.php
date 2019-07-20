<?php

namespace App\Http\Controllers\Admin\Overrides;

use Brackets\Media\Http\Controllers\FileUploadController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class ModifiedFileUploadController extends FileUploadController {

	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function upload( Request $request ) {

		if ( $request->hasFile( 'file' ) ) {
			$path = $request->file( 'file' )->store( '', [ 'disk' => 'uploads' ] );

			return response()->json( [ 'path' => $path ], 200 );
		}

		return response()->json( trans( 'brackets/media::media.file.not_provided' ), 422 );
	}
}
