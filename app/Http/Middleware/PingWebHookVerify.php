<?php

namespace App\Http\Middleware;

use Closure;

class PingWebHookVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // POST 原始请求数据是待验签数据，请根据实际情况获取
        $raw_data = file_get_contents('php://input');
        $signature = $request->header('x-pingplusplus-signature');
        $pub_key_path =  dirname(__FILE__)."/rsa_public_key.pem";
        $result = $this->verify_signature($raw_data, $signature, $pub_key_path);

        if ($result === 1) {
            return $next($request);
        } elseif ($result === 0) {
            return response('验证失败',403);
        } else {
            return response('错误',403);
        }

    }

    // 验证 webhooks 签名
    function verify_signature($raw_data, $signature, $pub_key_path) {
        $pub_key_contents = file_get_contents($pub_key_path);
        // php 5.4.8 以上，第四个参数可用常量 OPENSSL_ALGO_SHA256
        return openssl_verify($raw_data, base64_decode($signature), $pub_key_contents, 'sha256');
    }
}
