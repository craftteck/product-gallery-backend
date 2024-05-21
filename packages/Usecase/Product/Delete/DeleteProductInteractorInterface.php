<?php

namespace Packages\Usecase\Product\Delete;

interface DeleteProductInteractorInterface {
    public function execute(DeleteProductCommand $command): void;
}
