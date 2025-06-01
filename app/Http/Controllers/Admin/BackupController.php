<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;
class BackupController extends Controller
{

public function index(Request $request)
{
    if ($request->ajax()) {
        $query = Backup::query();

        // Search
        $search = $request->get('search')['value'] ?? '';
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                  ->orWhere('created_at', 'like', "%$search%");
            });
        }

        $count = $query->count();

        $records = $query->skip($request->start)
            ->take($request->length)
            ->get();

        $data = [];

        foreach ($records as $key => $value) {


$date =Carbon::parse($value->backup_date)->format('Y-m-d');
$time = Carbon::parse($value->backup_time)->format('H:i:s');
            $action = '<div class="btn-group">';
            $action .= '<a class="btn btn-danger" href="' . URL::to('admin/backup/delete/' . $value->id) . '">Delete</a>';
            $action .= '</div>';

            $data[] = [
                $value->id,
                $date,
                $time,
                $action,
            ];
        }

        return response()->json([
            "draw" => $request->draw,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            'data' => $data,
        ]);
    }

    return view('admin.backup.index');
}


public function download()
{
    $dbHost = env('DB_HOST');
    $dbUser = env('DB_USERNAME');
    $dbPass = env('DB_PASSWORD');
    $dbName = env('DB_DATABASE');

    $timestamp = Carbon::now('Asia/Karachi')->format('Y_m_d_His');
    $filename = "{$dbName}_backup_{$timestamp}.sql";
    $filepath = storage_path("app/{$filename}");

    $safePassword = str_replace("'", "'\\''", $dbPass);
    $command = "mysqldump -h {$dbHost} -u {$dbUser} -p'{$safePassword}' {$dbName} > {$filepath}";

    exec($command, $output, $returnVar);

    if ($returnVar !== 0 || !file_exists($filepath)) {
        return response()->json([
            'error' => 'Backup failed. Check credentials, permissions, or mysqldump installation.'
        ], 500);
    }


    Backup::create([
        'action'       => 'Database Backup',
        'backlog'      => "Backup file created: {$filename}",
        'backup_date'  => Carbon::now('Asia/Karachi')->toDateString(),
        'backup_time'  => Carbon::now('Asia/Karachi')->toTimeString(),
    ]);


    return response()->download($filepath)->deleteFileAfterSend(true);
}

public function delete($id)
{
    $backup = Backup::find($id);

    if (!$backup) {
        return redirect()->back()->with('error', 'Backup not found.');
    }

    $backup->delete();

    return redirect()->back()->with('success', 'Backup deleted successfully.');
}






}
