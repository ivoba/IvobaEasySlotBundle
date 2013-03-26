<?php

namespace Ivoba\EasySlotBundle;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

class Store {

    protected $storeDir;
    protected $file;
    protected $Collection;

    function __construct($storeDir, $file) {
        $this->storeDir = $storeDir;
        $this->file = $file;
        $this->Collection = array();
    }

    function getConfDir() {
        return $this->storeDir;
    }

    function getConfFile() {
        return $this->file;
    }

    function create($key, $C) {
        $this->Collection[$key] = $C;
    }

    function delete($key) {
        if (isset($this->Collection[$key])) {
            unset($this->Collection[$key]);
            return true;
        }
        return false;
    }

    function persist() {
        $file = $this->storeDir . $this->file;
        try {
            return file_put_contents($file, serialize($this->Collection) . ";");
        } catch (\Exception $exc) {
            echo $exc->getTraceAsString();
            return false;
        }
    }

    function load() {
        try {
            $file = $this->storeDir . $this->file;
            if (file_exists($file)) {
                $this->Collection = unserialize(file_get_contents($file));
                return $this->Collection;
            } else {
                throw new NotFoundHttpException(sprintf('File not found in "%s"', $file));
            }
        } catch (NotFoundHttpException $e) {
            return false;
        }
    }

    function export() {
        $file = $this->storeDir . $this->file;
        //TODO export in different formats
        $response = new Response();
        $response->headers->set('Content-Type', 'application/x-httpd-php');
        $response->headers->set('Content-Disposition', 'attachment; filename='.$this->file);
        readfile($file);
        return $response;
    }

}

