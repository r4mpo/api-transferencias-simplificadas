<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface crudTemplate
{
    public function index(): JsonResponse;
    public function store(Request $request): JsonResponse;
    public function show(string $id): JsonResponse;
    public function update(Request $request, string $id): JsonResponse;
    public function destroy(string $id): JsonResponse;
}