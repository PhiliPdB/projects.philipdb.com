<?php

class main {

    /**
     * @var mysqli
     */
    private $db;

    /**
     * @var array links and names of the pages in the navigation
     */
    public $navigation = [
    ];

    public function __construct($setupDb = false) {

        if ($setupDb) {
            $this->setupDb();
        }
    }

    /**
     * Get file with version
     *
     * @param $file
     *
     * @return string
     */
    public function version($file) {
        return $file . '?' . filemtime($file);
    }

    /**
     * Get older projects
     *
     * @return bool|mixed
     */
    public function getProjects() {
        if ($this->db == null) {
            return false;
        }

        $projects = $this->db->query("SELECT * FROM old_projects_categories ORDER BY opc_priority ASC")->fetch_all(MYSQLI_ASSOC);

        foreach ($projects as &$project) {
            // Get projects
            $project["projects"] = $this->db
                ->query("SELECT * FROM old_projects WHERE old_project_opc_id = " . $project["opc_id"] . " ORDER BY old_project_name ASC")
                ->fetch_all(MYSQLI_ASSOC);
            // Get category links
            $project["opc_links"] = $this->db->query("SELECT * FROM old_projects_category_links WHERE opcl_opc_id = " . $project["opc_id"])->fetch_all(MYSQLI_ASSOC);
        }

        return $projects;
    }

    /**
     * Setup database connection
     *
     * @throws Exception
     */
    private function setupDb() {
        require "config.php";

        $this->db = new mysqli($db_credentials['host'], $db_credentials['username'], $db_credentials['password'], $db_credentials['db_name']);
        if ($this->db->connect_errno) {
            throw new Exception($this->db->connect_error, $this->db->connect_errno);
        }
        $this->db->set_charset("utf8");
    }
}
