<?php
namespace App\Controllers;

use App\Models\MetadataModel;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MetadataController extends BaseController
{

    public function index()
    {
        $user = session()->get('user');

        $userModel = new UserModel();

        if (! session()->has('user')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

                           // Configure pagination
        $dataPerPage  = 5; // Number of rows per page
        $data['user'] = $userModel->where('deleted_at', null);

        $metadataModel    = new MetadataModel();
        $data['metadata'] = $metadataModel->metaDataStatus();

        // $data = [
        //     'metadata'       => $metadataModel->paginate($dataPerPage), // Paginated metadata
        //     'pager'          => $metadataModel->pager,                  // Pager object for pagination links
        //     'metadataStatus' => $metadataModel->metaDataStatus(),       // Fetch metadata status if needed
        // ];
        $data = $this->filterMetadata();
        return view('song_page', $data); // Loads the frontend search view
    }

    public function filterMetadata()
    {
        $model       = new MetadataModel();
        $dataPerPage = 5;
        $filters     = [
            'songName'           => $this->request->getGet('song_name'),
            'parentLabelCompany' => $this->request->getGet('label_name'),
            'isrc'               => $this->request->getGet('isrc'),
            'status'             => $this->request->getGet('status'),
            'date_range'         => $this->request->getGet('date_range'),
        ];

        $filteredData = $model->getFilteredMetadata($filters);

        $response = [
            'metadata'       => $filteredData,
                                                          // 'pager'          => $model->pager,
            'metadataStatus' => $model->metaDataStatus(), // You can include status if needed
        ];
        return $response;
        // return $this->response->setJSON($response);

    }

    public function exportToExcel()
    {
        // Retrieve filters from the POST request
        $filters = [
            'songName'           => $this->request->getPost('song_name'),
            'parentLabelCompany' => $this->request->getPost('label_name'),
            'isrc'               => $this->request->getPost('isrc'),
            'status'             => $this->request->getPost('status'),
            'date_range'         => $this->request->getPost('date_range'),
        ];

        $metadataModel = new MetadataModel();
        $metadata      = $metadataModel->getFilteredMetadata($filters);

        // Create Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Song Name');
        $sheet->setCellValue('B1', 'ISRC');
        $sheet->setCellValue('C1', 'Singer');
        $sheet->setCellValue('D1', 'Music Label');
        $sheet->setCellValue('E1', 'Status');

        $row = 2; // Data starts from row 2
        foreach ($metadata as $data) {
            $sheet->setCellValue('A' . $row, $data['songName']);
            $sheet->setCellValue('B' . $row, $data['isrc']);
            $sheet->setCellValue('C' . $row, $data['artist'] ?? 'NA');
            $sheet->setCellValue('D' . $row, $data['parentLabelCompany'] ?? 'NA');
            $sheet->setCellValue('E' . $row, $data['status_name']);
            $row++;
        }

        // Set headers for Excel download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="metadata.xlsx"');
        header('Cache-Control: max-age=0');

        // Save and output the Excel file
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    // public function exportToExcel()
    // {

    //     // Get filters from POST request using CodeIgniter 4 request object
    //     $filters = [
    //         'songName'           => $this->request->getPost('song_name'),
    //         'parentLabelCompany' => $this->request->getPost('label_name'),
    //         'isrc'               => $this->request->getPost('isrc'),
    //         'status'             => $this->request->getPost('status'),
    //         'date_range'         => $this->request->getPost('date_range'),
    //     ];

    //     $metadataModel = new MetadataModel();
    //     $metadata      = $metadataModel->getFilteredMetadata($filters); // Fetch filtered data

    //     // Create Spreadsheet object
    //     $spreadsheet = new Spreadsheet();
    //     $sheet       = $spreadsheet->getActiveSheet();

    //     // Set column headers
    //     $sheet->setCellValue('A1', 'Song Name');
    //     $sheet->setCellValue('B1', 'ISRC');
    //     $sheet->setCellValue('C1', 'Singer');
    //     $sheet->setCellValue('D1', 'Music Label');
    //     $sheet->setCellValue('E1', 'Status');

    //               // Fill data into the sheet
    //     $row = 2; // Start from the second row
    //     foreach ($metadata as $data) {
    //         $sheet->setCellValue('A' . $row, $data['songName']);
    //         $sheet->setCellValue('B' . $row, $data['isrc']);
    //         $sheet->setCellValue('C' . $row, $data['artist'] ?? 'NA');
    //         $sheet->setCellValue('D' . $row, $data['parentLabelCompany'] ?? 'NA');
    //         $sheet->setCellValue('E' . $row, $data['status_name']);
    //         $row++;
    //     }

    //     // Set headers for download
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="metadata.xlsx"');
    //     header('Cache-Control: max-age=0');

    //     // Save the spreadsheet to output
    //     $writer = new Xlsx($spreadsheet);
    //     $writer->save('php://output');
    //     exit;
    // }

}