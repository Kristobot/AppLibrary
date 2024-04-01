<?php
namespace App\Services;

use App\Models\Loan;
use App\Models\Copy;
use Illuminate\Http\Request;

class LoanService{

    public function create(?Request $request, array $copiesId): ?Loan
    {

        $loan = Loan::create([
            'user_id' => $request->user()->id,
        ]);

        $this->setStatus($this->tranformObjectCopy($copiesId), 2);

        $loan->copies()->attach($copiesId);

        return $loan->refresh();
    }

    public function returnCopies(Loan $loan)
    {
        
        $this->setStatus($loan->copies, 1);
    }

    private function setStatus($copies, int $status)
    {
        foreach ($copies as $copy) {
            $copy->update([
                'copy_status_id' => $status
            ]);
        }
    }

    private function tranformObjectCopy(array $copiesId): array
    {
        $objectCopies = [];
        foreach ($copiesId as $id) {
            $objectCopies[] = Copy::findOrFail($id);
        }

        return $objectCopies;
    }

}