<?php

namespace App\Jobs\Products;

use App\Models\Product;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;
use Vindi\Product as VindiProduct;

class ProductStoreJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Product $product) {}

    public function handle(): void
    {
        try {
            $vindiProductService = new VindiProduct(config('app.vindi_args'));
            $vindiProduct = $vindiProductService->create($this->product->normalize());

            $this->product->update(['external_id' => $vindiProduct->id]);

            Log::debug('Product created succesfully!');
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if ($response instanceof ResponseInterface) {
                $statusCode = $response->getStatusCode();
                $reasonPhrase = $response->getReasonPhrase();
                $body = $response->getBody()->getContents();

                Log::error("Guzzle RequestException: HTTP $statusCode $reasonPhrase. Response body: $body");
            } else {
                Log::error('Guzzle RequestException without response: '.$e->getMessage());
            }
        } catch (GuzzleException $e) {
            Log::error('GuzzleException: '.$e->getMessage());
        } catch (Exception $e) {
            Log::error('Error on creating Vindi Product: '.$e->getMessage());
        }
    }
}
