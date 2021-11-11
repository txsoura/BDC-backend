<?php

namespace App\Http\Middleware;

use App\Enums\CompanyStatus;
use App\Models\Company;
use App\Models\CompanyUser;
use Closure;
use Illuminate\Http\Request;

class XCompany
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $companyId = (int)$request->header('X-Company');

        if (!$companyId) {
            return response()->json([
                'message' => 'Please provide X-Company header',
                'error' => 'X-Company header not provided'
            ], 400);
        }

        $companyUser = CompanyUser::whereUserId(auth()->user()->id)
            ->whereCompanyId($companyId)
            ->first();

        if (!$companyUser) {
            return response()->json([
                'message' => 'You do not belong to this company',
                'error' => 'Invalid X-Company'
            ], 403);
        }

        $company = Company::whereId($companyId)
            ->whereStatus(CompanyStatus::APPROVED)
            ->first();

        if (!$company) {
            return response()->json([
                'message' => 'Please contact your company owner or admin, to review subscriptions',
                'error' => 'Unable to access company information'
            ], 402);
        }

        return $next($request);
    }
}
