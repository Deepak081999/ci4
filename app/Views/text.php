--- MetadataController code

public function index()
{
$user = session()->get('user');

$userModel = new UserModel();

if (! session()->has('user')) {
return redirect()->to('/login')->with('error', 'Please login first.');
}

$perPage = 10; // Number of records per page
$data['user'] = $userModel->where('deleted_at', null)->paginate($perPage);

// $metadataModel = new MetadataModel();

$data = $this->filterMetadata();
return view('song_page', $data); // Loads the frontend search view
}

public function filterMetadata()
{
$model = new MetadataModel();
$page = $this->request->getVar('page_metadata_data') ?? 1;
$perPage = 5; // Number of items per page
// $dateRange = $this->request->getGet('date_range');
// $dateArr = explode(' - ', $dateRange);
// $startDate = $dateArr[0];
// $endDate = $dateArr[2];

$filters = [
'songName' => $this->request->getGet('song_name'),
'parentLabelCompany' => $this->request->getGet('label_name'),
'isrc' => $this->request->getGet('isrc'),
'status' => $this->request->getGet('status'),
'date_range' => $this->request->getGet('date_range'),
];

$filteredData = $model->getFilteredMetadata($filters);

$data = [
'metadata' => $filteredData,
'metadataStatus' => $model->metaDataStatus(),

];

return $data;
}

-- MetadataModel
public function getFilteredMetadata($filters)
{
$query = $this->select('metadata_data.*, client_data.parentLabelCompany, metadata_status.status_name')
->join('client_data', 'metadata_data.musicLabel = client_data.id', 'left')
->join('metadata_status', 'metadata_data.status = metadata_status.status_id', 'left');

// Apply filters dynamically
if (! empty($filters['songName'])) {
$query->like('metadata_data.songName', $filters['songName']);
}
if (! empty($filters['parentLabelCompany'])) {
$query->whereIn('client_data.parentLabelCompany', explode(',', $filters['parentLabelCompany']));
}
if (! empty($filters['isrc'])) {
$query->where('metadata_data.isrc', $filters['isrc']);
}
if (! empty($filters['status'])) {
$query->where('metadata_data.status', $filters['status']);
}
if (! empty($filters['date_range'])) {
$dates = explode(' - ', $filters['date_range']);
if (count($dates) === 2) {
$query->where('metadata_data.createdOn >=', $dates[0]);
$query->where('metadata_data.createdOn <=', $dates[1]); } } return $query->findAll();
    }