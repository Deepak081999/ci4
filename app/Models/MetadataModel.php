<?php
namespace App\Models;

use CodeIgniter\Model;

class MetadataModel extends Model
{
    protected $table         = 'metadata_data';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['songName', 'isrc', 'upc', 'singer', 'musicLabel', 'status', 'release_date'];

    // Fetch all metadata with relationships (client_data and metadata_status)
    public function getMetadata()
    {
        return $this->select('metadata_data.*, client_data.parentLabelCompany, metadata_status.status_name')
            ->join('client_data', 'metadata_data.musicLabel = client_data.id', 'left')
            ->join('metadata_status', 'metadata_data.status = metadata_status.status_id', 'left')
            ->findAll();
    }

    // Fetch metadata based on filters
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
            $query->where('metadata_status.status_id', $filters['status']);
        }
        if (! empty($filters['date_range'])) {
            $dates = explode(' - ', $filters['date_range']);
            if (count($dates) === 2) {
                $query->where('metadata_data.createdOn >=', $dates[0]);
                $query->where('metadata_data.createdOn <=', $dates[1]);
            }
        }

        return $query->findAll();
    }

    public function metaDataStatus()
    {
        return $this->db->table('metadata_status')->select('*')->get()->getResultArray();

    }
}